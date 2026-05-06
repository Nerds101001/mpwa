<div class="tab-pane fade show" id="vcardmessage" role="tabpanel">
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
		<label for="name" class="form-label"><?php echo e(__('Name')); ?></label>
		<input type="text" name="name" class="form-control" placeholder="john wick" id="name" required />
		<label for="phone" class="form-label"><?php echo e(__('Number')); ?></label>
		<input type="tel" name="phone" class="form-control" placeholder="6281xxxxxxx" id="phone" inputmode="numeric" pattern="[0-9]*" required />
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-outline-primary btn-sm px-5"><?php echo e(__('Send Message')); ?></button>
		</div>
		<input type="hidden" name="type" value="vcard" />
	</form>
</div>
<script>
	const numberInput = document.getElementById('phone');
	numberInput.addEventListener('input', function(e) {
	    let inputValue = this.value.replace(/[^0-9]/g, '');
	    this.value = inputValue;
	}, { passive: true });
</script><?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/ajax/test/formvcard.blade.php ENDPATH**/ ?>