<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Test Messages')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Test Messages')).'']); ?>

    <!--breadcrumb-->
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);"><?php echo e(__('Message')); ?></a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active"><?php echo e(__('Test')); ?></li>
		</ol>
	</nav>
    <!--end breadcrumb-->
    <?php if(session()->has('alert')): ?>
        <?php if (isset($component)) { $__componentOriginal5194778a3a7b899dcee5619d0610f5cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php $__env->slot('type', session('alert')['type']); ?>
            <?php $__env->slot('msg', session('alert')['msg']); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $attributes = $__attributesOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__attributesOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf)): ?>
<?php $component = $__componentOriginal5194778a3a7b899dcee5619d0610f5cf; ?>
<?php unset($__componentOriginal5194778a3a7b899dcee5619d0610f5cf); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if($errors->any()): ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<h4 class="alert-heading d-flex align-items-center">
				<span class="alert-icon rounded">
					<i class="icon-base ti tabler-face-id-error icon-md"></i>
				</span>
				<?php echo e(__('Oh Error :(')); ?>

			</h4>
			<hr>
			<p class="mb-0">
				<p><?php echo e(__('The given data was invalid.')); ?></p>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
			</p>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
    <?php endif; ?>
    
	<?php if(!session()->has('selectedDevice')): ?>
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center"><?php echo e(__('Please select a device first')); ?></div>
			</div>
		</div>
	<?php else: ?>
<div class="card shadow-sm border-0">
	<div class="card-header">
		<h5 class="card-title mb-0"><?php echo e(__('Test Message')); ?></h5>
	</div>
		<div class="card-body px-4 pb-4">
			<div class="row g-4">
				<div class="col-lg-3">
					<ul class="nav nav-pills flex-column mt-2" role="tablist">
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link active d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#textmessage" role="tab" aria-selected="true">
								<i class="ti tabler-message-2 me-2"></i>
								<span class="text-start"><?php echo e(__('Text Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#mediamessage" role="tab">
								<i class="ti tabler-photo me-2"></i>
								<span class="text-start"><?php echo e(__('Media Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#productmessage" role="tab">
								<i class="ti tabler-apps me-2"></i>
								<span class="text-start"><?php echo e(__('Product Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#channelmessage" role="tab">
								<i class="ti tabler-speakerphone me-2"></i>
								<span class="text-start"><?php echo e(__('Channel Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#stickermessage" role="tab">
								<i class="ti tabler-sticker me-2"></i>
								<span class="text-start"><?php echo e(__('Sticker Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#pollmessage" role="tab">
								<i class="ti tabler-chart-pie me-2"></i>
								<span class="text-start"><?php echo e(__('Poll Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#listmessage" role="tab">
								<i class="ti tabler-list-details me-2"></i>
								<span class="text-start"><?php echo e(__('List Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#locationmessage" role="tab">
								<i class="ti tabler-map-pin me-2"></i>
								<span class="text-start"><?php echo e(__('Location Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#vcardmessage" role="tab">
								<i class="ti tabler-id me-2"></i>
								<span class="text-start"><?php echo e(__('VCard Message')); ?></span>
							</a>
						</li>
						<li class="nav-item mb-2" role="presentation">
							<a class="nav-link d-flex align-items-center justify-content-start" data-bs-toggle="tab" href="#buttonmessage" role="tab">
								<i class="ti tabler-square-rounded-plus me-2"></i>
								<span class="text-start"><?php echo e(__('Button Message')); ?> (*)</span>
							</a>
						</li>
					</ul>
				</div>

				<div class="col-lg-9">
					<div class="tab-content pt-2">
						<?php echo $__env->make('theme::ajax.test.formtext', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formmedia', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formproduct', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formchannel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formsticker', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formpoll', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formlist', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formlocation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formvcard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
						<?php echo $__env->make('theme::ajax.test.formbutton', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
					</div>
				</div>
			</div>
		</div>
</div>
<?php endif; ?>

    

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $attributes = $__attributesOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__attributesOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald819fa024fa6d382567c72bcf8897f25)): ?>
<?php $component = $__componentOriginald819fa024fa6d382567c72bcf8897f25; ?>
<?php unset($__componentOriginald819fa024fa6d382567c72bcf8897f25); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/pages/messagetest.blade.php ENDPATH**/ ?>