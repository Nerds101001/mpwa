<div class="tab-pane fade show" id="channelmessage" role="tabpanel">
    <form class="row g-3" action="<?php echo e(route('messagetest')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="col-md-12">
            <label class="form-label"><?php echo e(__('Sender')); ?></label>
            <input name="sender" value="<?php echo e(session('selectedDevice')['device_body'] ?? ''); ?>" type="text" class="form-control" readonly>
			<input type="hidden" name="type" value="textchannel" />
        </div>

        <div class="col-md-12 position-relative">
            <label class="form-label"><?php echo e(__('Channel URL')); ?></label>
            <input type="text" class="form-control" id="channelUrl" placeholder="https://whatsapp.com/channel/0029Vxxxxxxx" required>
            <div id="loadingIconChannel" class="spinner-border text-primary position-absolute" style="right:15px;top:34px;display:none;width:1.2rem;height:1.2rem;" role="status"></div>
        </div>
		
		<input type="hidden" name="number" id="channelId">
        <div id="channelPreview" class="col-12" style="display: none;">
			<div class="card border shadow-sm">
				<div class="card-body d-flex flex-column flex-md-row align-items-center">
					<div class="me-md-3 mb-3 mb-md-0">
						<img id="channelImage" src="" class="rounded border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
					</div>
					<div class="text-center text-md-start">
						<h6 id="channelName" class="mb-1"></h6>
						<small id="channelDescription" class="text-muted d-block mb-1"></small>
						<small id="channelCreatedAt" class="text-muted"><i class="ti tabler-calendar me-1"></i></small>
					</div>
				</div>
			</div>
		</div>

        <div class="col-12">
			<div class="card border border-info-subtle shadow-none mb-2">
				<div class="card-body d-flex flex-column gap-2">
					<div class="d-flex align-items-center gap-2">
						<i class="ti tabler-info-circle text-info fs-4"></i>
						<div class="fw-medium"><?php echo e(__('Message Variables & Spintax')); ?></div>
					</div>
					<div class="text-body-secondary small">
						<?php echo e(__('Use Spintax to randomize text with {A|B}. Tokens:')); ?>

					</div>
					<div class="d-flex flex-wrap gap-2">
						<button type="button" class="btn btn-sm btn-outline-secondary insert-token" data-token="{number}">{number}</button>
						<button type="button" class="btn btn-sm btn-outline-secondary insert-token" data-token="{random_text}">{random_text}</button>
						<button type="button" class="btn btn-sm btn-outline-secondary insert-token" data-token="{random_num}">{random_num}</button>
						<button type="button" class="btn btn-sm btn-outline-info wrap-spintax" data-a="Hi" data-b="Hello"><?php echo e(__('Wrap {A|B}')); ?></button>
					</div>
					<div class="small">
						<div class="mb-1"><span class="text-nowrap"><?php echo e(__('Example')); ?></span>: <code><?php echo e(__('{Hi|Hello}')); ?> <?php echo e(__('your number is')); ?> {number}</code></div>
						<div class="mb-1"><span class="text-nowrap"><?php echo e(__('Samples')); ?></span>: <code><?php echo e(__('Tag')); ?>: {random_text}</code> • <code><?php echo e(__('ID')); ?>: {random_num}</code></div>
						<div class="text-body-tertiary"><?php echo e(__('{random_text} is 4 random letters, e.g.')); ?> kdmw <?php echo e(__('and {random_num} is 4 random digits, e.g.')); ?> 9392</div>
					</div>
				</div>
			</div>
            <label for="inputText1" class="form-label"><?php echo e(__('Text Message')); ?></label>
            <textarea id="inputText1" name="message" placeholder="<?php echo e(__('Example : {Hi|Hello} your number is {number}')); ?>" class="form-control" rows="3" required></textarea>
        </div>

        <div class="col-12">
            <label for="footer" class="form-label"><?php echo e(__('Footer message *optional')); ?></label>
            <input type="text" name="footer" class="form-control" id="footer">
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-outline-primary btn-sm px-5"><?php echo e(__('Send Message')); ?></button>
        </div>
    </form>
</div>

<script>
		function insertAtCursor(field, text) {
			var start = field.selectionStart || 0
			var end = field.selectionEnd || 0
			var val = field.value
			field.value = val.substring(0, start) + text + val.substring(end)
			var pos = start + text.length
			field.setSelectionRange(pos, pos)
			field.focus()
		}
		document.querySelectorAll('.insert-token').forEach(function(el){
			el.addEventListener('click', function(e){
				e.preventDefault()
				var ta = document.getElementById('inputText1')
				if (!ta) return
				insertAtCursor(ta, this.dataset.token)
			})
		})
		document.querySelectorAll('.wrap-spintax').forEach(function(el){
			el.addEventListener('click', function(e){
				e.preventDefault()
				var ta = document.getElementById('inputText1')
				if (!ta) return
				var start = ta.selectionStart || 0
				var end = ta.selectionEnd || 0
				var selected = ta.value.substring(start, end)
				var a = selected && selected.trim().length ? selected : (this.dataset.a || 'Hi')
				var b = this.dataset.b || 'Hello'
				var text = '{' + a + '|' + b + '}'
				insertAtCursor(ta, text)
			})
		})
document.getElementById('channelUrl').addEventListener('input', function () {
    const url = this.value.trim();
    if (!url.includes('whatsapp.com/channel/')) {
        notyf.error('<?php echo e(__("Make sure you are using the correct link (whatsapp.com/channel/)")); ?>');
        return;
    }

    const input = this;
    const loader = document.getElementById('loadingIconChannel');
    input.disabled = true;
    loader.style.display = 'inline-block';

    fetch(`<?php echo e(route('fetch.channel')); ?>`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        },
        body: JSON.stringify({ url })
    })
    .then(res => res.json())
    .then(res => {
        if (res.status && res.data) {
            const data = res.data;
            const name = data.thread_metadata?.name?.text || '-';
            const desc = data.thread_metadata?.description?.text || '-';
            const img = data.thread_metadata?.preview?.direct_path 
                ? "https://pps.whatsapp.net" + data.thread_metadata.preview.direct_path 
                : '';
            const created = data.thread_metadata?.creation_time 
                ? new Date(data.thread_metadata.creation_time * 1000).toLocaleString()
                : '-';

            document.getElementById('channelName').textContent = name;
            document.getElementById('channelDescription').textContent = desc;
            document.getElementById('channelImage').src = img;
            document.getElementById('channelCreatedAt').textContent = '<?php echo e(__("Created at:")); ?> ' + created;
            document.getElementById('channelId').value = data.id.replace('@newsletter', '') || '';

            document.getElementById('channelPreview').style.display = 'block';
        } else {
            notyf.error('<?php echo e(__("Failed to fetch channel data")); ?>');
        }
    })
    .catch(() => notyf.error('<?php echo e(__("Failed to fetch channel data")); ?>'))
    .finally(() => {
        input.disabled = false;
        loader.style.display = 'none';
    });
});
</script>
<?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/ajax/test/formchannel.blade.php ENDPATH**/ ?>