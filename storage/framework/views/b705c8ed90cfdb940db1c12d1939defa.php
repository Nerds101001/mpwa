<div class="tab-pane fade show" id="mediamessage" role="tabpanel">
	<form class="row g-3" action="<?php echo e(route('messagetest')); ?>" method="POST">
		<?php echo csrf_field(); ?>
		<div class="col-12">
			<label class="form-label"><?php echo e(__('Sender')); ?></label>
			<input name="sender" value="<?php echo e(session()->get('selectedDevice')['device_body'] ?? ''); ?>" type="text" class="form-control" readonly>
		</div>
		<div class="col-12">
			<label class="form-label"><?php echo e(__('Receiver Number')); ?> *</label>
			<textarea placeholder="628xxx|628xxx|628xxx" class="form-control" name="number" id="" cols="20" rows="2" required></textarea>
		</div>
		<label class="form-label"><?php echo e(__('Media Url')); ?> </label>
		<div class="input-group media-area">
			<span class="input-group-btn">
			<a id="image" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
			<i class="fa fa-picture-o"></i> <?php echo e(__('Choose')); ?>

			</a>
			</span>
			<input id="thumbnail" class="form-control" type="text" name="url">
		</div>
		<div class="form-group mt-4">
			<label class="form-label me-3"><?php echo e(__('View Once')); ?></label>
			<div class="form-check form-switch">
				<input class="form-check-input toggle-read" type="checkbox" name="viewonce" value="true" id="toggle-switch-once">
				<label class="form-check-label" for="toggle-switch-once" id="toggle-label-once"><?php echo e(__('No')); ?></label>
				<small>(<?php echo e(__('Only works with images & videos')); ?>)</small>
			</div>
		</div>
		<div class="form-group mt-4">
			<label class="form-label"><?php echo e(__('Media Type')); ?></label>
			<div class="d-flex">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="media_type" id="customRadioInline1" value="image">
					<label class="form-check-label" for="customRadioInline1"><?php echo e(__('Image')); ?></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="media_type" id="customRadioInline4" value="document" checked>
					<label class="form-check-label" for="customRadioInline4"><?php echo e(__('Document')); ?></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="media_type" id="customRadioInline2" value="video">
					<label class="form-check-label" for="customRadioInline2"><?php echo e(__('Video')); ?></label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="media_type" id="customRadioInline3" value="audio">
					<label class="form-check-label" for="customRadioInline3"><?php echo e(__('Voice Note')); ?></label>
				</div>
			</div>
		</div>
		<input type="hidden" name="type" value="media" />
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
		<div class="form-group caption-area mt-4">
			<label for="caption" class="form-label"><?php echo e(__('Caption')); ?></label>
			<textarea type="text" name="caption" class="form-control" id="caption" required></textarea>
			<label for="footer" class="form-label mt-3"><?php echo e(__('Footer message *optional')); ?></label>
			<input type="text" name="footer" class="form-control" id="footer">
		</div>
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-outline-primary btn-sm px-5"><?php echo e(__('Send Message')); ?></button>
		</div>
	</form>
</div>
<script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>?v=<?php echo e(config('app.version')); ?>"></script>
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
	window.addEventListener('load', function() {
		document.querySelectorAll('.insert-token').forEach(function(el){
			el.addEventListener('click', function(e){
				e.preventDefault()
				var ta = document.getElementById('caption')
				if (!ta) return
				insertAtCursor(ta, this.dataset.token)
			})
		})
		document.querySelectorAll('.wrap-spintax').forEach(function(el){
			el.addEventListener('click', function(e){
				e.preventDefault()
				var ta = document.getElementById('caption')
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
	    const toggleSwitch = document.getElementById('toggle-switch-once');
	    const toggleLabel = document.getElementById('toggle-label-once');
	
	    toggleSwitch.addEventListener('change', function() {
	        if (this.checked) {
	            toggleLabel.textContent = "<?php echo e(__('Yes')); ?>";
	        } else {
	            toggleLabel.textContent = "<?php echo e(__('No')); ?>";
	        }
	    });
	});
</script><?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/ajax/test/formmedia.blade.php ENDPATH**/ ?>