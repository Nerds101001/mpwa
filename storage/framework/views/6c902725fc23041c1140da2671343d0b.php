
<div class="alert alert-<?php echo e($type); ?> alert-dismissible" role="alert">
<?php if($type == 'success'): ?>
	<h4 class="alert-heading d-flex align-items-center">
		<span class="alert-icon rounded">
			<i class="icon-base ti tabler-coffee icon-md"></i>
		</span>
		Well done :)
	</h4>
<?php elseif($type == 'danger'): ?>
	<h4 class="alert-heading d-flex align-items-center">
		<span class="alert-icon rounded">
			<i class="icon-base ti tabler-face-id-error icon-md"></i>
		</span>
		Oh Error :(
	</h4>
<?php elseif($type == 'warning'): ?>
	<h4 class="alert-heading d-flex align-items-center">
		<span class="alert-icon rounded">
			<i class="icon-base ti tabler-alert-square-rounded icon-md"></i>
		</span>
		Warning :|
	</h4>
<?php endif; ?>
	<hr>
	<p class="mb-0"><?php echo e($msg); ?></p>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div><?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/components/alert.blade.php ENDPATH**/ ?>