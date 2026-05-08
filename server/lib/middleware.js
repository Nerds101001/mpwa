const wa = require("../whatsapp");
const { formatReceipt } = require("./helper");
const fs = require("fs");

const checkDestination = async (req, res, next) => {
  const { token, number } = req.body;
  if (token && number) {
    try {
      const check = await wa.isExist(token, formatReceipt(number));

      if (!check) {
        return res.send({
          status: false,
          message:
            "The destination Number not registered in WhatsApp or your sender not connected",
        });
      }
      next();
    } catch (error) {
      console.error('[Middleware] checkDestination error:', error);
      res.send({ status: false, message: "Error checking destination number" });
    }
  } else {
    res.send({ status: false, message: "Check your parameter" });
  }
};

const checkConnectionBeforeBlast = async (req, res, next) => {
  let data;
  try {
    data = JSON.parse(req.body.data);
  } catch (err) {
    return res.status(400).send({ status: false, message: "Invalid JSON data" });
  }

  const timeout = (promise, ms, message = 'Operation timed out') => {
    return Promise.race([
      promise,
      new Promise((_, reject) => setTimeout(() => reject(new Error(message)), ms))
    ]);
  };

  try {
    console.log(`[Middleware] Checking connection for device: ${data.sender}`);
    // Wait max 15 seconds for connection check
    const status = await timeout(wa.connectToWhatsApp(data.sender), 15000, 'Connection check timed out');
    
    if (!status) {
      console.warn(`[Middleware] Device ${data.sender} is unauthorized or disconnected`);
      return res.send({
        status: false,
        message: `Unauthorized: Device ${data.sender} is not connected`,
      });
    }
    
    console.log(`[Middleware] Device ${data.sender} is connected. Proceeding to blast.`);
    next();
  } catch (error) {
    console.error(`[Middleware] Connection check failed for ${data.sender}:`, error.message);
    return res.send({
      status: false,
      message: `Connection error: ${error.message}`,
    });
  }
};

module.exports = { checkDestination, checkConnectionBeforeBlast };
