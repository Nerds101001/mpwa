const { dbQuery } = require('../database'),
  { formatReceipt } = require('../lib/helper'),
  wa = require('../whatsapp')

const campaignQueues = new Map()

const scheduleCampaignExecution = (campaignId, task) => {
  const previous = campaignQueues.get(campaignId) ?? Promise.resolve()
  const hasRunningJob = campaignQueues.has(campaignId)

  if (hasRunningJob) {
    console.log(`[Queue] Campaign ${campaignId} is already running. Queuing this batch.`)
  } else {
    console.log(`[Queue] Campaign ${campaignId} is idle. Starting this batch immediately.`)
  }

  const nextJob = previous
    .catch((err) => {
      console.error(`[Queue] Previous batch for campaign ${campaignId} failed:`, err)
    })
    .then(async () => {
      console.log(`[Queue] Starting next batch for campaign ${campaignId}`)
      await task()
    })
    .catch(error => {
      console.error(`[Queue] Failed to process campaign ${campaignId} batch:`, error)
    })
    .finally(() => {
      if (campaignQueues.get(campaignId) === nextJob) {
        console.log(`[Queue] Campaign ${campaignId} has no more queued batches. Marking as idle.`)
        campaignQueues.delete(campaignId)
      }
    })

  campaignQueues.set(campaignId, nextJob)

  return !hasRunningJob
}

const updateStatus = async (campaignId, receiver, status) => {
  try {
    await dbQuery(
      "UPDATE blasts SET status = '" +
        status +
        "' WHERE receiver = '" +
        receiver +
        "' AND campaign_id = '" +
        campaignId +
        "'"
    )
    console.log(`[Campaign ${campaignId}] Updated status for ${receiver} to ${status}`)
  } catch (err) {
    console.error(`[Campaign ${campaignId}] Failed to update status for ${receiver}:`, err)
  }
}

const checkBlast = async (campaignId, receiver) => {
  try {
    const result = await dbQuery(
      "SELECT status FROM blasts WHERE receiver = '" +
        receiver +
        "' AND campaign_id = '" +
        campaignId +
        "'"
    )
    return result.length > 0 && result[0].status === 'pending'
  } catch (err) {
    console.error(`[Campaign ${campaignId}] Error checking blast status for ${receiver}:`, err)
    return false
  }
}

const sendBlastMessage = async (req, res) => {
  let parsedData

  try {
    parsedData = JSON.parse(req.body.data)
  } catch (error) {
    console.error('[Blast] Failed to parse request data:', error)
    return res.status(400).send({ status: false, message: 'Invalid payload' })
  }

  const { campaign_id: campaignId, data: messageData } = parsedData || {}

  if (!campaignId) {
    console.error('[Blast] Missing campaign identifier in payload')
    return res.status(400).send({ status: false, message: 'Missing campaign identifier' })
  }

  if (!Array.isArray(messageData) || messageData.length === 0) {
    return res.send({ status: 'in_progress', queued: false, processed: 0 })
  }

  console.log(`[Blast] Received batch of ${messageData.length} messages for campaign ${campaignId}`)

  const processCampaign = async () => {
    const delay = ms => new Promise(resolve => setTimeout(resolve, ms))
    const timeout = (promise, ms, message = 'Operation timed out') => {
      return Promise.race([
        promise,
        new Promise((_, reject) => setTimeout(() => reject(new Error(message)), ms))
      ])
    }

    const parsedMinDelay = Number(parsedData.delay)
    const minDelay = Number.isFinite(parsedMinDelay) ? Math.max(0, parsedMinDelay) : 0
    const parsedMaxDelay = Number(parsedData.delay_max)
    const maxDelay = Number.isFinite(parsedMaxDelay) ? Math.max(minDelay, parsedMaxDelay) : minDelay

    const retryCounts = new Map()

    for (let index = 0; index < messageData.length; index++) {
      const item = messageData[index]

      if (!item) {
        continue
      }

      console.log(`[Campaign ${campaignId}] [Step 1/5] Processing message ${index + 1}/${messageData.length} to ${item.receiver}`);
      
      const shouldDelay = maxDelay > 0 || minDelay > 0
      if (shouldDelay) {
        const delayRange = maxDelay > minDelay ? maxDelay - minDelay + 1 : 1
        const delaySec = maxDelay > minDelay
          ? Math.floor(Math.random() * delayRange) + minDelay
          : minDelay
        if (delaySec > 0) {
          console.log(`[Campaign ${campaignId}] [Step 2/5] Delaying for ${delaySec} seconds...`);
          await delay(delaySec * 1000)
        }
      }

      if (!parsedData.sender || !item.receiver || !item.message) {
        console.warn(`[Campaign ${campaignId}] Skipping invalid item at index ${index}`);
        continue
      }

      console.log(`[Campaign ${campaignId}] [Step 3/5] Verifying if ${item.receiver} is still pending in DB...`);
      const blastStillPending = await checkBlast(campaignId, item.receiver)
      if (!blastStillPending) {
        console.log(`[Campaign ${campaignId}] Message to ${item.receiver} is no longer pending or already processed, skipping.`);
        continue
      }

      try {
        console.log(`[Campaign ${campaignId}] [Step 4/5] Checking if ${item.receiver} is on WhatsApp...`);
        const exists = await timeout(wa.isExist(parsedData.sender, formatReceipt(item.receiver)), 30000, 'isExist timed out')
        if (!exists) {
          console.log(`[Campaign ${campaignId}] Receiver ${item.receiver} does not exist on WhatsApp. Marking as failed.`);
          await updateStatus(campaignId, item.receiver, 'failed')
          continue
        }
      } catch (err) {
        console.error(`[Campaign ${campaignId}] Existence check failed for ${item.receiver}:`, err.message);
        await updateStatus(campaignId, item.receiver, 'failed')
        continue
      }

      try {
        let sendResult
        console.log(`[Campaign ${campaignId}] [Step 5/5] Executing send command for ${item.receiver} (Type: ${parsedData.type})...`);

        if (parsedData.type === 'media') {
          const mediaMessage = JSON.parse(item.message)
          if (mediaMessage.caption && mediaMessage.caption.trim() !== '') {
            if (mediaMessage.footer && mediaMessage.footer.trim() !== '') {
              mediaMessage.caption = `${mediaMessage.caption}\n\n> _${mediaMessage.footer}_`
              delete mediaMessage.footer
            }
          } else if (mediaMessage.footer && mediaMessage.footer.trim() !== '') {
            mediaMessage.caption = `> _${mediaMessage.footer}_`
            delete mediaMessage.footer
          }
          sendResult = await timeout(wa.sendMedia(
            parsedData.sender,
            item.receiver,
            mediaMessage.type,
            mediaMessage.url,
            mediaMessage.caption,
            0,
            mediaMessage.viewonce,
            mediaMessage.filename
          ), 30000, 'sendMedia timed out')
        } else if (parsedData.type === 'sticker') {
          const stickerMessage = JSON.parse(item.message)
          sendResult = await timeout(wa.sendSticker(
            parsedData.sender,
            item.receiver,
            stickerMessage.type,
            stickerMessage.url,
            stickerMessage.filename
          ), 30000, 'sendSticker timed out')
        } else if (parsedData.type === 'button') {
          const buttonData = JSON.parse(item.message)
          const buttons = buttonData.buttons.map(buttonRawData => {
            const raw = buttonRawData.buttonText?.displayText || {}
            return {
              type: raw.type || 'reply',
              displayText: raw.displayText,
              id: buttonRawData.buttonId,
              phoneNumber: raw.phoneNumber,
              url: raw.url,
              copyCode: raw.copyCode
            }
          })
          sendResult = await timeout(wa.sendButtonMessage(
            parsedData.sender,
            item.receiver,
            buttons,
            buttonData.caption || buttonData.text || '',
            buttonData.footer,
            buttonData.image?.url
          ), 30000, 'sendButtonMessage timed out')
        } else {
          const msg = JSON.parse(item.message)
          if (msg.text && msg.footer && msg.text.trim() !== '') {
            msg.text = wa.randomizeText(`${msg.text}\n\n> _${msg.footer}_`)
            delete msg.footer
          }
          sendResult = await timeout(wa.sendMessage(
            parsedData.sender,
            item.receiver,
            msg
          ), 30000, 'sendMessage timed out')
        }

        const status = sendResult ? 'success' : 'failed'
        console.log(`[Campaign ${campaignId}] Send result for ${item.receiver}: ${status}`);
        await updateStatus(campaignId, item.receiver, status)
        
        // Reset retry count on success or intentional failure
        retryCounts.delete(item.receiver)

      } catch (sendError) {
        const errorMsg = sendError?.message || 'Unknown error'
        console.error(`[Campaign ${campaignId}] Error sending to ${item.receiver}:`, errorMsg);
        
        if (errorMsg.includes('503')) {
          const currentRetries = retryCounts.get(item.receiver) || 0
          if (currentRetries < 3) {
            console.log(`[Campaign ${campaignId}] 503 Error. Retrying ${item.receiver} (Attempt ${currentRetries + 1}/3) after 5s...`);
            retryCounts.set(item.receiver, currentRetries + 1)
            await delay(5000)
            index-- // Retry same message
          } else {
            console.error(`[Campaign ${campaignId}] 503 Error persistent for ${item.receiver}. Giving up after 3 attempts.`);
            await updateStatus(campaignId, item.receiver, 'failed')
            retryCounts.delete(item.receiver)
          }
        } else {
          await updateStatus(campaignId, item.receiver, 'failed')
        }
      }
    }
    console.log(`[Campaign ${campaignId}] Finished processing this batch of ${messageData.length} messages.`);
  }

  const startedImmediately = scheduleCampaignExecution(campaignId, processCampaign)

  res.send({ status: 'in_progress', queued: !startedImmediately })
}

module.exports = { sendBlastMessage }