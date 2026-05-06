<div class="tab-pane fade show" id="stickermessage" role="tabpanel">
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
		<label class="form-label"><?php echo e(__('Image Url')); ?> </label>
		<div class="input-group media-area">
			<span class="input-group-btn">
			<a id="image-sticker" data-input="thumbnail-sticker" data-preview="holder" class="btn btn-primary text-white">
			<i class="fa fa-picture-o"></i> <?php echo e(__('Choose')); ?>

			</a>
			</span>
			<input id="thumbnail-sticker" class="form-control" type="text" name="url">
		</div>
		<input type="hidden" name="type" value="sticker" />
		<div class="col-12 text-center">
			<button type="submit" class="btn btn-outline-primary btn-sm px-5"><?php echo e(__('Send Message')); ?></button>
		</div>
	</form>
</div><?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/ajax/test/formsticker.blade.php ENDPATH**/ ?>