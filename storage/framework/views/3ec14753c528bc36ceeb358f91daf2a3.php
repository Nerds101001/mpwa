<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Auto Replies')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Auto Replies')).'']); ?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" defer></script>
	<style>
		.bootstrap-tagsinput {
			width: 100%;
			padding: 0.5rem;
			display: flex;
			flex-wrap: wrap;
		}

		.bootstrap-tagsinput input {
			flex: 1;
			min-width: 50px;
			border: none;
		}

		.bootstrap-tagsinput .tag {
			margin-right: 5px;
			margin-bottom: 5px;
			color: white;
			background-color: var(--bs-primary);
			padding: 0.2rem 0.5rem;
			border-radius: 0.2rem;
		}
	</style>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb-custom-icon">
			<li class="breadcrumb-item">
				<a href="javascript:void(0);"><?php echo e(__('Whatsapp')); ?></a>
				<i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
			</li>
			<li class="breadcrumb-item active"><?php echo e(__('Auto Reply')); ?></li>
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
	
	<?php if(!session()->has('selectedDevice')): ?>
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center"><?php echo e(__('Please select a device first')); ?></div>
			</div>
		</div>
	<?php else: ?>
	<div class="card">
		<div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
			<h5 class="card-title mb-0">
				<?php echo e(__('Lists auto respond')); ?>

				<?php if(Session::has('selectedDevice')): ?>
					<span class="text-muted small">(<?php echo e(Session::get('selectedDevice')['device_body']); ?>)</span>
				<?php endif; ?>
			</h5>

			<div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
				<button type="button"
						class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1"
						data-bs-toggle="offcanvas"
						data-bs-target="#addAutoRespondOffcanvas"
						aria-controls="addAutoRespondOffcanvas">
					<i class="ti tabler-plus me-1"></i>  <?php echo e(__('New Auto Reply')); ?>

				</button>

				<form method="GET" class="position-relative">
					<button type="submit" class="btn position-absolute top-50 start-0 translate-middle-y ps-3 pe-2 border-0 bg-transparent">
						<i class="ti tabler-search"></i>
					</button>
					<input type="text"
						   name="keyword"
						   class="form-control ps-5 pe-3"
						   placeholder="<?php echo e(__('search')); ?>"
						   value="<?php echo e(request()->get('keyword', '')); ?>">
				</form>
			</div>
		</div>
		<div class="card-body" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
	<div>
		<table class="table table-hover align-middle text-center w-100" style="font-size: 0.78rem; table-layout: auto;">
			<thead class="border-top">
				<tr class="align-middle">
					<th><?php echo e(__('Keyword')); ?></th>
					<th><?php echo e(__('Details')); ?></th>
					<th><?php echo e(__('Status')); ?></th>
					<th><?php echo e(__('Read')); ?></th>
					<th><?php echo e(__('Typing')); ?></th>
					<th><?php echo e(__('Quoted')); ?></th>
					<th><?php echo e(__('Delay')); ?></th>
					<th><?php echo e(__('Type')); ?></th>
					<th><?php echo e(__('Action')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php if(Session::has('selectedDevice')): ?>
					<?php if($autoreplies->total() == 0): ?>
						<?php if (isset($component)) { $__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.no-data','data' => ['colspan' => '9','text' => ''.e(__('No Autoreplies added yet')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('no-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => '9','text' => ''.e(__('No Autoreplies added yet')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc)): ?>
<?php $attributes = $__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc; ?>
<?php unset($__attributesOriginalf93c233e0d4ceea9c88c0d88798bcfbc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc)): ?>
<?php $component = $__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc; ?>
<?php unset($__componentOriginalf93c233e0d4ceea9c88c0d88798bcfbc); ?>
<?php endif; ?>
					<?php endif; ?>

					<?php $__currentLoopData = $autoreplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $autoreply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr data-reply-id="<?php echo e($autoreply->id); ?>">
							<td>
								<input type="text" name="id" class="form-control form-control-sm keyword-update tags-input"
									   data-id="<?php echo e($autoreply->id); ?>"
									   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
									   value="<?php echo e($autoreply->keyword); ?>">
							</td>
							<td>
								<div class="d-grid gap-1">
									<div class="btn btn-outline-success btn-xs text-wrap"><?php echo e(__($autoreply['type_keyword'])); ?></div>
									<div class="btn btn-outline-warning btn-xs text-wrap"><?php echo e(__($autoreply['reply_when'])); ?></div>
								</div>
							</td>
							<td>
								<div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
									<input type="checkbox" class="form-check-input toggle-status"
										   data-id="<?php echo e($autoreply->id); ?>"
										   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
										   <?php echo e($autoreply->status == 'active' ? 'checked' : ''); ?>>
								</div>
								<small class="d-block mt-1 text-muted"><?php echo e(__($autoreply->status)); ?></small>
							</td>
							<td>
								<div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
									<input type="checkbox" class="form-check-input toggle-read"
										   data-id="<?php echo e($autoreply->id); ?>"
										   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
										   <?php echo e($autoreply->is_read ? 'checked' : ''); ?>>
								</div>
								<small class="d-block mt-1 text-muted"><?php echo e($autoreply->is_read ? __('Yes') : __('No')); ?></small>
							</td>
							<td>
								<div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
									<input type="checkbox" class="form-check-input toggle-typing"
										   data-id="<?php echo e($autoreply->id); ?>"
										   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
										   <?php echo e($autoreply->is_typing ? 'checked' : ''); ?>>
								</div>
								<small class="d-block mt-1 text-muted"><?php echo e($autoreply->is_typing ? __('Yes') : __('No')); ?></small>
							</td>
							<td>
								<div class="form-check form-switch d-inline-flex align-items-center justify-content-center">
									<input type="checkbox" class="form-check-input toggle-quoted"
										   data-id="<?php echo e($autoreply->id); ?>"
										   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
										   <?php echo e($autoreply->is_quoted ? 'checked' : ''); ?>>
								</div>
								<small class="d-block mt-1 text-muted"><?php echo e($autoreply->is_quoted ? __('Yes') : __('No')); ?></small>
							</td>
							<td style="width: 80px;">
								<input type="text" name="delay" class="form-control form-control-sm delay-update"
									   data-id="<?php echo e($autoreply->id); ?>"
									   data-url="<?php echo e(route('autoreply.update', $autoreply->id)); ?>"
									   value="<?php echo e($autoreply->delay); ?>">
							</td>
							<td><?php echo e(__($autoreply['type'])); ?></td>
							<td>
								<div class="d-flex justify-content-center gap-1">
									<a href="javascript:;" onclick="viewReply(<?php echo e($autoreply->id); ?>)"
									   class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip"
									   data-bs-placement="bottom" title="<?php echo e(__('Views')); ?>">
										<i class="ti tabler-eye"></i>
									</a>
									<a href="<?php echo e(route('autoreply.edit', ['id' => $autoreply->id])); ?>"
									   class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip"
									   data-bs-placement="bottom" title="<?php echo e(__('Edit')); ?>">
										<i class="ti tabler-edit"></i>
									</a>
									<form action="<?php echo e(route('autoreply.delete')); ?>" method="POST" class="d-inline delete-form">
										<?php echo csrf_field(); ?>
										<?php echo method_field('delete'); ?>
										<input type="hidden" name="id" value="<?php echo e($autoreply->id); ?>">
										<button type="submit" name="delete" class="btn btn-outline-danger btn-sm"
												data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo e(__('Delete')); ?>">
											<i class="ti tabler-trash"></i>
										</button>
									</form>
								</div>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<tr>
						<td colspan="9" class="text-center text-muted"><?php echo e(__('Please select device')); ?></td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>

	<div class="row mx-3 justify-content-between">
		<?php echo e($autoreplies->links('pagination::bootstrap-5')); ?>

	</div>
</div>

	</div>
	<div class="offcanvas offcanvas-end" tabindex="-1" id="addAutoRespondOffcanvas" aria-labelledby="addAutoRespondOffcanvasLabel" data-bs-backdrop="static" style="width: 600px;">
		<div class="offcanvas-header">
			<h5 id="addAutoRespondOffcanvasLabel" class="offcanvas-title"><?php echo e(__('Add Auto Reply')); ?></h5>
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body p-0 d-flex flex-column">
			<form action="" method="POST" enctype="multipart/form-data" id="formautoreply" class="d-flex flex-column h-100">
				<?php echo csrf_field(); ?>

				<div class="p-3">
					<?php if(Session::has('selectedDevice')): ?>
						<input type="hidden" name="device" value="<?php echo e(Session::get('selectedDevice.device_id')); ?>">
						<input type="hidden" name="device_body" id="device" class="form-control" value="<?php echo e(Session::get('selectedDevice.device_body')); ?>" readonly>
					<?php else: ?>
						<input type="text" name="devicee" id="device" class="form-control mb-3" value="<?php echo e(__('Please select device')); ?>" readonly>
					<?php endif; ?>

					<div class="row g-3">
						<div class="col-lg-6">
							<div class="border rounded p-3 h-100">
								<label class="form-label d-block mb-2"><?php echo e(__('Type Keyword')); ?></label>
								<div class="btn-group w-100" role="group" aria-label="type-keyword">
									<input type="radio" value="Equal" name="type_keyword" checked class="btn-check" id="keywordTypeEqual">
									<label class="btn btn-outline-primary" for="keywordTypeEqual"><?php echo e(__('Equal')); ?></label>
									<input type="radio" value="Contain" name="type_keyword" class="btn-check" id="keywordTypeContain">
									<label class="btn btn-outline-primary" for="keywordTypeContain"><?php echo e(__('Contains')); ?></label>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="border rounded p-3 h-100">
								<label class="form-label d-block mb-2"><?php echo e(__('Only reply when sender is')); ?></label>
								<div class="btn-group w-100" role="group" aria-label="reply-when">
									<input type="radio" value="Group" name="reply_when" class="btn-check" id="replyWhenGroup">
									<label class="btn btn-outline-primary" for="replyWhenGroup"><?php echo e(__('Group')); ?></label>
									<input type="radio" value="Personal" name="reply_when" class="btn-check" id="replyWhenPersonal">
									<label class="btn btn-outline-primary" for="replyWhenPersonal"><?php echo e(__('Personal')); ?></label>
									<input type="radio" value="All" checked name="reply_when" class="btn-check" id="replyWhenAll">
									<label class="btn btn-outline-primary" for="replyWhenAll"><?php echo e(__('All')); ?></label>
								</div>
							</div>
						</div>

						<div class="col-12">
							<div class="border rounded p-3">
								<label for="keywordInputAdd" class="form-label"><?php echo e(__('Keyword')); ?></label>
								<div id="keywordTokensAdd" class="d-flex flex-wrap gap-1 mb-2"></div>
								<input type="text" id="keywordInputAdd" class="form-control" placeholder="<?php echo e(__('e.g. hello, info, price')); ?>">
								<input type="hidden" name="keyword" id="keywordHiddenAdd" value="">
								<div class="form-text"><?php echo e(__('Press (Enter) to add keywords.')); ?></div>
							</div>
						</div>

						<div class="col-12">
							<div class="border rounded p-3">
								<label for="type" class="form-label"><?php echo e(__('Type Reply')); ?></label>
								<select name="type" id="type" class="form-select" required>
									<option selected disabled><?php echo e(__('Select One')); ?></option>
									<option value="text"><?php echo e(__('Text Message')); ?></option>
									<option value="media"><?php echo e(__('Media Message')); ?></option>
									<option value="product"><?php echo e(__('Product Message')); ?></option>
									<option value="location"><?php echo e(__('Location Message')); ?></option>
									<option value="sticker"><?php echo e(__('Sticker Message')); ?></option>
									<option value="vcard"><?php echo e(__('VCard Message')); ?></option>
									<option value="list"><?php echo e(__('List Message')); ?></option>
									<option value="button"><?php echo e(__('Button Message (Must with image)')); ?></option>
								</select>
								<div class="ajaxplace mt-3"></div>
								<div id="loadjs"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="border-top bg-body p-3 mt-auto">
					<div class="d-flex justify-content-between gap-2">
						<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="offcanvas">
							<i class="ti tabler-x"></i> <?php echo e(__('Close')); ?>

						</button>
						<button id="btnAddAutoReply" type="submit" name="submit" class="btn btn-outline-primary btn-sm">
							<i class="ti tabler-send"></i> <?php echo e(__('Add')); ?>

						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalViewLabel"><?php echo e(__('Auto Reply Preview')); ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body showReply">
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel"><?php echo e(__('Confirm Deletion')); ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body"><?php echo e(__('Are you sure you want to delete this auto reply?')); ?></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
					<button type="button" class="btn btn-outline-danger btn-sm" id="confirmDeleteBtn"><?php echo e(__('Delete')); ?></button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.3.3/dist/leaflet.js"></script>
	<script src="<?php echo e(asset('js/autoreply2.js')); ?>?v=<?php echo e(config('app.version')); ?>"></script>
	<script>
		document.addEventListener('DOMContentLoaded',function(){
			var hidden=document.getElementById('keywordHiddenAdd');
			var input=document.getElementById('keywordInputAdd');
			var box=document.getElementById('keywordTokensAdd');
			var tokens=[];
			function render(){
				box.innerHTML='';
				tokens.forEach(function(t,i){
					var s=document.createElement('span');
					s.className='badge rounded-pill bg-primary d-inline-flex align-items-center px-3 py-2';
					s.textContent=t;
					var x=document.createElement('a');
					x.href='javascript:void(0)';
					x.className='btn btn-sm btn-link ms-2 p-0 text-white';
					x.innerHTML='<i class="ti tabler-x"></i>';
					x.onclick=function(){tokens.splice(i,1);update();render();};
					s.appendChild(x);
					box.appendChild(s);
				});
			}
			function update(){
				hidden.value=tokens.join(',');
			}
			function add(v){
				var t=(v||'').trim();
				if(t&&tokens.indexOf(t)===-1){tokens.push(t);update();render();}
			}
			input.addEventListener('keydown',function(e){
				if(e.key==='Enter'){e.preventDefault();add(input.value);input.value='';}
			});
			input.addEventListener('paste',function(e){
				var text=(e.clipboardData||window.clipboardData).getData('text');
				if(text&&text.indexOf(',')!==-1){e.preventDefault();text.split(',').forEach(function(p){add(p);});input.value='';}
			});
			render();

			var form=document.getElementById('formautoreply');
			var btn=document.getElementById('btnAddAutoReply');
			btn.addEventListener('click',function(e){
				e.preventDefault();
				if(!form.checkValidity()){
					form.classList.add('was-validated');
					var invalid=form.querySelector(':invalid');
					if(invalid){ invalid.focus(); invalid.scrollIntoView({behavior:'smooth',block:'center'}); }
					return;
				}
				if(form.requestSubmit){ form.requestSubmit(); } else { HTMLFormElement.prototype.submit.call(form); }
			});
		});
		function loadScript(url) {
			var script = document.createElement('script');
			script.src = url;
			document.getElementById("loadjs").appendChild(script);
		}

		function viewReply(id) {
			$.ajax({
				url: "<?php echo e(route('previewMessage')); ?>",
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
				},
				type: "POST",
				data: {
					id: id,
					table: "autoreplies",
					column: "reply",
				},
				dataType: "html",
				success: (result) => {
					$(".showReply").html(result);
					$("#modalView").modal("show");
				},
				error: (error) => {
					console.log(error);
				},
			});
		}
		
		window.addEventListener('load', function() {
			$(document).ready(function() {
				$('#type').on('change', () => {
					const type = $('#type').val();
					$.ajax({
						url: "<?php echo e(route('formMessage', ['type' => '___TYPE___'])); ?>".replace('___TYPE___', type),
						type: "GET",
						dataType: "html",
						success: (result) => {
							document.getElementById('loadjs').innerHTML = '';
							$(".ajaxplace").html(result);
							loadScript('<?php echo e(asset("js/text.js")); ?>?v=<?php echo e(config("app.version")); ?>');
							loadScript('<?php echo e(asset("vendor/laravel-filemanager/js/stand-alone-button2.js")); ?>?v=<?php echo e(config("app.version")); ?>');
						},
						error: (error) => {
							console.log(error);
						},
					});
				});

				const deleteModalEl = document.getElementById('deleteConfirmationModal');
				const deleteModal = new bootstrap.Modal(deleteModalEl);
				const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

				$(document).on('submit', '.delete-form', function(e) {
					e.preventDefault();
					
					const replyId = $(this).find('input[name="id"]').val();
					
					$(confirmDeleteBtn).data('id', replyId);
					
					deleteModal.show();
				});

				$(confirmDeleteBtn).on('click', function() {
					const replyId = $(this).data('id');
					if (!replyId) return;

					const formData = new FormData();
					formData.append('_method', 'delete');
					formData.append('id', replyId);

					fetch("<?php echo e(route('autoreply.delete')); ?>", {
						method: 'POST',
						headers: { 
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						if (data.error === false) {
							if(window.notyf) window.notyf.success(data.message);
							
							const row = document.querySelector('tr[data-reply-id="' + replyId + '"]');
							if (row) {
								$(row).fadeOut(400, function() {
									$(this).remove();
								});
							}
						} else {
							if(window.notyf) window.notyf.error(data.message);
						}
					})
					.catch(error => {
						console.error('Error:', error);
						if(window.notyf) window.notyf.error('<?php echo e(__("An error occurred while deleting.")); ?>');
					})
					.finally(() => {
						deleteModal.hide();
					});
				});
			});
		});
	</script>
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
<?php endif; ?><?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/pages/autoreply.blade.php ENDPATH**/ ?>