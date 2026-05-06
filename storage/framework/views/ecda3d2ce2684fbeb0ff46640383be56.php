<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Phone book')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Phone book')).'']); ?>
	<style>
	.phone-book-list .list-group-item.active, .phone-book-list .list-group-item:hover {
		background: rgba(13, 110, 253, .08);
	}
	.phone-book-list .list-group-item.active, .phone-book-list .list-group-item:active {
		border: 1px solid rgba(13, 110, 253, .08);
	}
	</style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom-icon">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);"><?php echo e(__('Phonebook')); ?></a>
                <i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
            </li>
            <li class="breadcrumb-item active"><?php echo e(__('Contact')); ?></li>
        </ol>
    </nav>

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

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0 d-flex align-items-center gap-2">
                <?php echo e(__('Phonebook')); ?>

            </h5>
            <div class="d-flex flex-wrap gap-2">
                <form action="<?php echo e(route('fetch.groups')); ?>" method="post" class="m-0">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="device" value="<?php echo e(Session::get('selectedDevice.device_id')); ?>">
                    <button type="submit" class="btn btn-outline-primary btn-sm">
                        <i class="ti tabler-device-mobile-message"></i> <?php echo e(__('Fetch From Selected Device')); ?>

                    </button>
                </form>
                <button onclick="clearPhonebook()" class="btn btn-outline-danger btn-sm">
                    <i class="ti tabler-trash"></i> <?php echo e(__('Clear Phonebook')); ?>

                </button>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 d-flex align-items-center gap-2">
                        <i class="ti tabler-folder text-primary"></i>
                        <?php echo e(__('Phonebook')); ?>

                    </h6>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addTag">
                        <i class="ti tabler-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control mb-3 search-phonebook" placeholder="<?php echo e(__('Search phonebook')); ?>">
                    <div class="list-group list-group-flush phone-book-list" style="max-height:460px;overflow:auto;">
                        <div class="text-center load-phonebook text-primary py-3">
                            <i class="ti tabler-loader-2 ti-spin"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-outline-secondary btn-sm load-more" data-page="1">
                        <i class="ti tabler-refresh"></i> <?php echo e(__('Load More')); ?>

                    </button>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
						<button onclick="deleteAllContact()" class="btn btn-sm btn-outline-danger">
							<i class="ti tabler-trash-x"></i> <?php echo e(__('Delete All')); ?>

						</button>

						<div class="flex-grow-1" style="min-width:240px;max-width:500px;">
							<div class="input-group input-group-sm">
								<span class="input-group-text"><i class="ti tabler-search"></i></span>
								<input type="text" class="form-control search-contact" placeholder="<?php echo e(__('Search contacts')); ?>">
							</div>
						</div>

						<div class="d-flex gap-2 flex-shrink-0">
							<button class="badge btn-sm bg-primary-subtle text-primary border-0" onclick="addContact()">
								<i class="ti tabler-user-plus"></i> <?php echo e(__('Add')); ?>

							</button>
							<button class="badge btn-sm bg-success-subtle text-success border-0" onclick="importContact()">
								<i class="ti tabler-upload"></i> <?php echo e(__('Import')); ?>

							</button>
							<button class="badge btn-sm bg-warning-subtle text-warning border-0" onclick="exportContact()">
								<i class="ti tabler-download"></i> <?php echo e(__('Export')); ?>

							</button>
						</div>
					</div>

                    <div class="contacts-list-wrapper">
						<div class="contacts-list"></div>
						<div class="text-center process-get-contact py-5">
							<div class="empty-state">
								<div class="mb-4">
									<i class="ti tabler-notebook" style="font-size: 4rem; color: #e0e0e0;"></i>
								</div>
								<h5 class="text-muted mb-2"><?php echo e(__('No Phonebook Selected')); ?></h5>
								<p class="text-muted small mb-0">
									<i class="ti tabler-info-circle me-1"></i>
									<?php echo e(__('Please select phonebook to show contact')); ?>

								</p>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTag" tabindex="-1" aria-labelledby="addTagLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagLabel"><?php echo e(__('Add Tag')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo e(__('Cancel')); ?>"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('tag.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <label for="tag_name" class="form-label"><?php echo e(__('Name')); ?></label>
                        <input type="text" name="name" class="form-control" id="tag_name" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><?php echo e(__('Add')); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="addContact" aria-labelledby="addContactLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="addContactLabel"><?php echo e(__('Add Contact')); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<?php echo e(__('Cancel')); ?>"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add-contact-form" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label for="contact_name" class="form-label"><?php echo e(__('Name')); ?></label>
                <input type="text" name="name" class="form-control contact-name" id="contact_name" required>
                <label for="contact_number" class="form-label mt-2"><?php echo e(__('Number')); ?></label>
                <input type="number" name="number" class="form-control contact-number" id="contact_number" required>
                <input type="hidden" class="input_phonebookid" name="tag_id" value=" ">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-secondary me-2" data-bs-dismiss="offcanvas"><?php echo e(__('Cancel')); ?></button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary add-contact"><?php echo e(__('Add')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="importContacts" aria-labelledby="importContactsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="importContactsLabel"><?php echo e(__('Import Contacts')); ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="<?php echo e(__('Cancel')); ?>"></button>
        </div>
        <div class="offcanvas-body">
            <form id="import-contact-form" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label for="fileContacts" class="form-label"><?php echo e(__('File (xlsx )')); ?></label>
                <input accept=".xlsx" type="file" name="fileContacts" class="form-control file-import" id="fileContacts" required>
                <input type="hidden" name="tag_id" value="" class="import_phonebookid">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-secondary me-2" data-bs-dismiss="offcanvas"><?php echo e(__('Cancel')); ?></button>
                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><?php echo e(__('Import')); ?></button>
                </div>
            </form>
        </div>
    </div>

    <script src="<?php echo e(asset('js/phonebook.js')); ?>?v=<?php echo e(config('app.version')); ?>"></script>
    <script>
	window.addEventListener('load', function() {
			$(document).ready(function() {
      var oldModal=$.fn.modal;
      $.fn.modal=function(action){
        var id=this.attr('id');
        if(id==='addContact'||id==='importContacts'){
          var el=document.getElementById(id);
          var ins=bootstrap.Offcanvas.getOrCreateInstance(el);
          if(action==='show'){ins.show();return this;}
          if(action==='hide'){ins.hide();return this;}
        }
        if(oldModal) return oldModal.apply(this, arguments);
        return this;
      };
	  });
		});
    </script>
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
<?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/pages/phonebook/index.blade.php ENDPATH**/ ?>