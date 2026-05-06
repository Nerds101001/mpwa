<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Ai Bot')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Ai Bot')).'']); ?>

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom-icon">
         <li class="breadcrumb-item">
            <a href="javascript:void(0);"><?php echo e(__('AI Bot')); ?></a>
            <i class="breadcrumb-icon icon-base ti tabler-chevron-right align-middle icon-xs"></i>
         </li>
         <li class="breadcrumb-item active"><?php echo e(__('Bot Options')); ?></li>
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
         <p class="mb-0"><?php echo e(__('The given data was invalid.')); ?></p>
         <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </ul>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

   <?php if(!session()->has('selectedDevice')): ?>
      <div class="card shadow-sm border-0">
         <div class="alert alert-danger m-4 text-center"><?php echo e(__('Please select a device first')); ?></div>
      </div>
   <?php else: ?>
      <div class="card border-0 shadow-sm">
         <div class="card-header border-bottom d-flex align-items-center justify-content-between py-3">
            <h5 class="mb-0 d-flex align-items-center gap-2"><?php echo e(__('AI Bot')); ?></h5>
         </div>
         <form action="<?php echo e(route('aibot')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="card-body p-4">
               <div class="mb-4">
                  <label class="form-label fw-semibold"><?php echo e(__('Bot Mode')); ?></label>
                  <div class="btn-group" role="group">
                     <?php $__currentLoopData = [0 => 'Disable', 1 => __('One Bot'), 2 => __('Multi Bot'), 3 => 'Bexa AI']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" class="btn-check" name="typebot" id="typebot_<?php echo e($value); ?>" value="<?php echo e($value); ?>" autocomplete="off"
                               <?php echo e($device->typebot == $value ? 'checked' : ''); ?>>
                        <label class="btn btn-outline-primary" for="typebot_<?php echo e($value); ?>"><?php echo e(__($label)); ?></label>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
               </div>
			   
			   <div id="common-options" style="display:none;">
				  <div class="card border shadow-sm mb-4">
					   <div class="card-body">
					   <div class="row g-3">
						  <div class="col-12">
												<label class="form-label fw-semibold"><?php echo e(__('Reply only when sender is:')); ?></label>
												<div class="d-flex gap-3 flex-wrap">
													<?php $__currentLoopData = ['Group', 'Personal', 'All']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="reply_when" id="reply_<?php echo e($option); ?>_bexa" value="<?php echo e($option); ?>"
																   <?php echo e($device->reply_when == $option ? 'checked' : ''); ?>>
															<label class="form-check-label" for="reply_<?php echo e($option); ?>_bexa"><?php echo e(__($option)); ?></label>
														</div>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</div>
											</div>

											<!-- Toggles -->
											<div class="col-md-4">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="reject_call" id="reject_call_bexa"
														   <?php echo e($device->reject_call == 1 ? 'checked' : ''); ?>>
													<label class="form-check-label" for="reject_call_bexa"><?php echo e(__('Reject Call Automatically')); ?></label>
												</div>
												<textarea name="reject_message" class="form-control mt-2" rows="3" placeholder="<?php echo e(__('Message sent when call is rejected')); ?>"><?php echo e($device->reject_message ?? ''); ?></textarea>
											</div>

											<div class="col-md-4">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="can_read_message" id="can_read_message_bexa"
														   <?php echo e($device->can_read_message == 1 ? 'checked' : ''); ?>>
													<label class="form-check-label" for="can_read_message_bexa"><?php echo e(__('Bot can read messages')); ?></label>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" name="bot_typing" id="bot_typing_bexa"
														   <?php echo e($device->bot_typing == 1 ? 'checked' : ''); ?>>
													<label class="form-check-label" for="bot_typing_bexa"><?php echo e(__('Bot typing indicator')); ?></label>
												</div>
											</div>
										</div>
					   </div>
					</div>
				</div>

               <div id="bot-options" style="display:none;">
					<div class="card border shadow-sm mb-4">
						<div class="card-body">
							<div class="row g-3">
								<!-- System Instructions -->
								<div class="col-12">
									<label class="form-label"><?php echo e(__('System Instructions (Prompt)')); ?></label>
									<textarea name="system_instructions" class="form-control" rows="3" placeholder="<?php echo e(__('Custom system instructions for AI models')); ?>"><?php echo e($device->system_instructions ?? ''); ?></textarea>
								</div>

								<!-- AI APIs -->
								<?php $llm = is_array($device->llm_models ?? null) ? $device->llm_models : json_decode($device->llm_models ?? '{}', true); ?>
								<?php $__currentLoopData = ['chatgpt' => 'ChatGPT', 'dalle' => 'DALL·E', 'gemini' => 'Gemini', 'claude' => 'Claude']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="col-md-6">
										<label class="form-label fw-semibold"><?php echo e($label); ?></label>
										<div class="row g-2">
											<div class="col-12 name-field d-none">
												<div class="input-group input-group-sm">
													<span class="input-group-text"><?php echo e(__('Name')); ?></span>
													<input type="text" name="<?php echo e($key); ?>_name" class="form-control" value="<?php echo e($device->{$key.'_name'} ?? ''); ?>" placeholder="Ex: <?php echo e($key); ?>">
												</div>
											</div>
											<div class="col-12">
												<div class="input-group input-group-sm">
													<span class="input-group-text"><?php echo e($label); ?> API</span>
													<input type="text" name="<?php echo e($key); ?>_api" class="form-control" value="<?php echo e($device->{$key.'_api'} ?? ''); ?>" placeholder="<?php echo e($label); ?> API Key">
												</div>
											</div>

											<?php if(in_array($key, ['chatgpt','gemini','claude'])): ?>
												<div class="col-12">
													<select name="<?php echo e($key); ?>_model" class="form-select form-select-sm">
														<option value=""><?php echo e(__('Use defaul')); ?></option>
														<?php $__currentLoopData = ($modelOptions[$key] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($m); ?>" <?php echo e((($llm[$key] ?? '') === $m) ? 'selected' : ''); ?>><?php echo e($m); ?></option>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</select>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
                </div>

               <div id="bexa-options" style="display:none;">
				   <div class="card border shadow-sm mb-4">
					  <div class="card-body">
						 <div class="row g-4">
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Bexa AI API Key')); ?> <small><a href="https://www.onexgen.com/mpwa/short/bexa" class="text-danger" target="_blank">(<?php echo e(__('Get API - Monthly Subscription')); ?>)</a></small></label>
							   <input type="text" name="bexa_api_key" class="form-control" value="<?php echo e($device->bexa_api_key); ?>" placeholder="<?php echo e(__('Enter Bexa AI API Key')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Model Name')); ?></label>
							   <input type="text" name="bexa_name" class="form-control" value="<?php echo e($device->bexa_name); ?>" placeholder="<?php echo e(__('Enter Model Name')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Company Name')); ?></label>
							   <input type="text" name="bexa_company_name" class="form-control" value="<?php echo e($device->bexa_company_name); ?>" placeholder="<?php echo e(__('Enter Company Name')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Company Website')); ?></label>
							   <input type="text" name="bexa_company_website" class="form-control" value="<?php echo e($device->bexa_company_website); ?>" placeholder="<?php echo e(__('Enter Company Website')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Company Address')); ?></label>
							   <input type="text" name="bexa_company_address" class="form-control" value="<?php echo e($device->bexa_company_address); ?>" placeholder="<?php echo e(__('Enter Company Address')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Company Phone')); ?></label>
							   <input type="tel" name="bexa_company_phone" class="form-control" value="<?php echo e($device->bexa_company_phone); ?>" placeholder="<?php echo e(__('Enter Company Phone')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Company Email')); ?></label>
							   <input type="email" name="bexa_company_email" class="form-control" value="<?php echo e($device->bexa_company_email); ?>" placeholder="<?php echo e(__('Enter Company Email')); ?>">
							</div>
							<div class="col-md-6">
							   <label class="form-label fw-semibold"><?php echo e(__('Language')); ?></label>
							   <select name="bexa_language" class="form-select">
								  <option value="all" <?php echo e($device->bexa_language == 'all' ? 'selected' : ''); ?>><?php echo e(__('All Languages')); ?></option>
								<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($value); ?>" <?php echo e($device->bexa_language == $value ? 'selected' : ''); ?>><?php echo e($name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							   </select>
							</div>

							<div class="col-md-12">
							   <label class="form-label fw-semibold d-block mb-2"><?php echo e(__('Mode')); ?></label>
							   <div class="btn-group" role="group">
								  <input type="radio" class="btn-check" name="bexa_mode" id="bexa_mode_chat" value="chat" <?php echo e($device->bexa_custom ? '' : 'checked'); ?>>
								  <label class="btn btn-outline-primary" for="bexa_mode_chat"><?php echo e(__('Chat')); ?></label>

								  <input type="radio" class="btn-check" name="bexa_mode" id="bexa_mode_custom" value="custom" <?php echo e($device->bexa_custom ? 'checked' : ''); ?>>
								  <label class="btn btn-outline-primary" for="bexa_mode_custom"><?php echo e(__('Custom')); ?></label>
							   </div>
							</div>
						 </div>
					  </div>
				   </div>

				   <div id="bexa-custom-fields" style="display:none;">
					  <div class="card border shadow-sm mb-4">
						 <div class="card-body">
							<div class="row g-4">
							   <div class="col-md-6">
								  <label class="form-label fw-semibold"><?php echo e(__('Function')); ?></label>
								  <select name="bexa_function" class="form-select">
									 <option value=""><?php echo e(__('Select Function')); ?></option>
									 <option value="customer_service" <?php echo e($device->bexa_function=='customer_service'?'selected':''); ?>><?php echo e(__('Customer Service')); ?></option>
									 <option value="support" <?php echo e($device->bexa_function=='support'?'selected':''); ?>><?php echo e(__('Support')); ?></option>
									 <option value="employee" <?php echo e($device->bexa_function=='employee'?'selected':''); ?>><?php echo e(__('Employee')); ?></option>
									 <option value="technical" <?php echo e($device->bexa_function=='technical'?'selected':''); ?>><?php echo e(__('Technical')); ?></option>
									 <option value="accounting" <?php echo e($device->bexa_function=='accounting'?'selected':''); ?>><?php echo e(__('Accounting')); ?></option>
									 <option value="ceo" <?php echo e($device->bexa_function=='ceo'?'selected':''); ?>><?php echo e(__('CEO')); ?></option>
									 <option value="sales" <?php echo e($device->bexa_function=='sales'?'selected':''); ?>><?php echo e(__('Sales')); ?></option>
								  </select>
							   </div>
							   <div class="col-md-6">
									<label class="form-label fw-semibold"><?php echo e(__('Industry')); ?></label>
									<select name="bexa_industry" class="form-select">
										<option value=""><?php echo e(__('Select Industry')); ?></option>
										<option value="hosting" <?php echo e($device->bexa_industry=='hosting'?'selected':''); ?>><?php echo e(__('Hosting')); ?></option>
										<option value="technology" <?php echo e($device->bexa_industry=='technology'?'selected':''); ?>><?php echo e(__('Technology')); ?></option>
										<option value="automotive" <?php echo e($device->bexa_industry=='automotive'?'selected':''); ?>><?php echo e(__('Automotive')); ?></option>
										<option value="finance" <?php echo e($device->bexa_industry=='finance'?'selected':''); ?>><?php echo e(__('Finance')); ?></option>
										<option value="healthcare" <?php echo e($device->bexa_industry=='healthcare'?'selected':''); ?>><?php echo e(__('Healthcare')); ?></option>
										<option value="education" <?php echo e($device->bexa_industry=='education'?'selected':''); ?>><?php echo e(__('Education')); ?></option>
										<option value="retail" <?php echo e($device->bexa_industry=='retail'?'selected':''); ?>><?php echo e(__('Retail')); ?></option>
										<option value="manufacturing" <?php echo e($device->bexa_industry=='manufacturing'?'selected':''); ?>><?php echo e(__('Manufacturing')); ?></option>
										<option value="construction" <?php echo e($device->bexa_industry=='construction'?'selected':''); ?>><?php echo e(__('Construction')); ?></option>
										<option value="food_beverage" <?php echo e($device->bexa_industry=='food_beverage'?'selected':''); ?>><?php echo e(__('Food & Beverage')); ?></option>
										<option value="media_entertainment" <?php echo e($device->bexa_industry=='media_entertainment'?'selected':''); ?>><?php echo e(__('Media & Entertainment')); ?></option>
										<option value="real_estate" <?php echo e($device->bexa_industry=='real_estate'?'selected':''); ?>><?php echo e(__('Real Estate')); ?></option>
										<option value="telecommunications" <?php echo e($device->bexa_industry=='telecommunications'?'selected':''); ?>><?php echo e(__('Telecommunications')); ?></option>
										<option value="travel_tourism" <?php echo e($device->bexa_industry=='travel_tourism'?'selected':''); ?>><?php echo e(__('Travel & Tourism')); ?></option>
										<option value="government" <?php echo e($device->bexa_industry=='government'?'selected':''); ?>><?php echo e(__('Government')); ?></option>
										<option value="energy" <?php echo e($device->bexa_industry=='energy'?'selected':''); ?>><?php echo e(__('Energy')); ?></option>
										<option value="agriculture" <?php echo e($device->bexa_industry=='agriculture'?'selected':''); ?>><?php echo e(__('Agriculture')); ?></option>
										<option value="transportation" <?php echo e($device->bexa_industry=='transportation'?'selected':''); ?>><?php echo e(__('Transportation')); ?></option>
										<option value="consulting" <?php echo e($device->bexa_industry=='consulting'?'selected':''); ?>><?php echo e(__('Consulting')); ?></option>
										<option value="fashion" <?php echo e($device->bexa_industry=='fashion'?'selected':''); ?>><?php echo e(__('Fashion')); ?></option>
										<option value="sports" <?php echo e($device->bexa_industry=='sports'?'selected':''); ?>><?php echo e(__('Sports')); ?></option>
										<option value="pharmaceutical" <?php echo e($device->bexa_industry=='pharmaceutical'?'selected':''); ?>><?php echo e(__('Pharmaceutical')); ?></option>
										<option value="biotechnology" <?php echo e($device->bexa_industry=='biotechnology'?'selected':''); ?>><?php echo e(__('Biotechnology')); ?></option>
										<option value="legal" <?php echo e($device->bexa_industry=='legal'?'selected':''); ?>><?php echo e(__('Legal')); ?></option>
										<option value="marketing_advertising" <?php echo e($device->bexa_industry=='marketing_advertising'?'selected':''); ?>><?php echo e(__('Marketing & Advertising')); ?></option>
										<option value="human_resources" <?php echo e($device->bexa_industry=='human_resources'?'selected':''); ?>><?php echo e(__('Human Resources')); ?></option>
										<option value="non_profit" <?php echo e($device->bexa_industry=='non_profit'?'selected':''); ?>><?php echo e(__('Non-Profit')); ?></option>
										<option value="logistics_supply_chain" <?php echo e($device->bexa_industry=='logistics_supply_chain'?'selected':''); ?>><?php echo e(__('Logistics & Supply Chain')); ?></option>
										<option value="environmental_services" <?php echo e($device->bexa_industry=='environmental_services'?'selected':''); ?>><?php echo e(__('Environmental Services')); ?></option>
										<option value="public_relations" <?php echo e($device->bexa_industry=='public_relations'?'selected':''); ?>><?php echo e(__('Public Relations')); ?></option>
										<option value="architecture_design" <?php echo e($device->bexa_industry=='architecture_design'?'selected':''); ?>><?php echo e(__('Architecture & Design')); ?></option>
										<option value="arts_culture" <?php echo e($device->bexa_industry=='arts_culture'?'selected':''); ?>><?php echo e(__('Arts & Culture')); ?></option>
										<option value="journalism_publishing" <?php echo e($device->bexa_industry=='journalism_publishing'?'selected':''); ?>><?php echo e(__('Journalism & Publishing')); ?></option>
										<option value="security" <?php echo e($device->bexa_industry=='security'?'selected':''); ?>><?php echo e(__('Security')); ?></option>
										<option value="gaming" <?php echo e($device->bexa_industry=='gaming'?'selected':''); ?>><?php echo e(__('Gaming')); ?></option>
										<option value="fitness_wellness" <?php echo e($device->bexa_industry=='fitness_wellness'?'selected':''); ?>><?php echo e(__('Fitness & Wellness')); ?></option>
										<option value="event_management" <?php echo e($device->bexa_industry=='event_management'?'selected':''); ?>><?php echo e(__('Event Management')); ?></option>
										<option value="scientific_research" <?php echo e($device->bexa_industry=='scientific_research'?'selected':''); ?>><?php echo e(__('Scientific Research')); ?></option>
										<option value="utilities" <?php echo e($device->bexa_industry=='utilities'?'selected':''); ?>><?php echo e(__('Utilities')); ?></option>
										<option value="insurance" <?php echo e($device->bexa_industry=='insurance'?'selected':''); ?>><?php echo e(__('Insurance')); ?></option>
										<option value="aerospace_defense" <?php echo e($device->bexa_industry=='aerospace_defense'?'selected':''); ?>><?php echo e(__('Aerospace & Defense')); ?></option>
										<option value="mining" <?php echo e($device->bexa_industry=='mining'?'selected':''); ?>><?php echo e(__('Mining')); ?></option>
									</select>
								</div>

							   <div class="col-12">
								  <label class="form-label fw-semibold"><?php echo e(__('Products Input Type')); ?></label>
								  <div class="btn-group" role="group">
									 <input type="radio" class="btn-check" name="bexa_product_input_type" id="bexa_product_link_type" value="link" <?php echo e($device->bexa_product_input_type=='link'?'checked':''); ?>>
									 <label class="btn btn-outline-primary" for="bexa_product_link_type"><?php echo e(__('Link')); ?></label>

									 <input type="radio" class="btn-check" name="bexa_product_input_type" id="bexa_product_manual_type" value="manual" <?php echo e($device->bexa_product_input_type=='manual'?'checked':''); ?>>
									 <label class="btn btn-outline-primary" for="bexa_product_manual_type"><?php echo e(__('Manual')); ?></label>
								  </div>
							   </div>

							   <div class="col-12" id="bexa-product-link-field" style="display:none;">
								  <label class="form-label fw-semibold"><?php echo e(__('Products JSON Link')); ?></label>
								  <input type="text" name="bexa_product_link" class="form-control" value="<?php echo e($device->bexa_product_link); ?>" placeholder="<?php echo e(__('Enter JSON URL')); ?>">
							   </div>

							   <div class="col-12" id="bexa-products-list" style="display:none;">
								  <?php $products = json_decode($device->bexa_products, true) ?: []; ?>
								  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									 <div class="product-item card border shadow-sm mb-3 rounded">
										<div class="card-body row g-3 align-items-center">
										   <div class="col-md-4">
											  <input type="text" name="bexa_products[<?php echo e($i); ?>][name]" class="form-control" placeholder="<?php echo e(__('Product Name')); ?>" value="<?php echo e($prod['name']); ?>">
										   </div>
										   <div class="col-md-4">
											  <input type="text" name="bexa_products[<?php echo e($i); ?>][description]" class="form-control" placeholder="<?php echo e(__('Description')); ?>" value="<?php echo e($prod['description']); ?>">
										   </div>
										   <div class="col-md-3">
											  <input type="text" name="bexa_products[<?php echo e($i); ?>][price]" class="form-control" placeholder="<?php echo e(__('Price')); ?>" value="<?php echo e($prod['price']); ?>">
										   </div>
										   <div class="col-md-1 text-end">
											  <button type="button" class="btn btn-sm bg-danger-subtle text-danger remove-product">
												 <i class="ti tabler-trash"></i>
											  </button>
										   </div>
										</div>
									 </div>
								  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

								  <button type="button" id="add-product" class="btn btn-outline-primary w-100">
									 <i class="ti tabler-plus me-1"></i> <?php echo e(__('Add Product')); ?>

								  </button>
							   </div>

							   <div class="col-12">
								  <div class="form-check form-switch">
									 <input class="form-check-input" type="checkbox" role="switch" name="bexa_system_custom_instructions" id="bexa_system_custom_instructions" <?php echo e($device->bexa_system_custom_instructions ? 'checked' : ''); ?>>
									 <label class="form-check-label" for="bexa_system_custom_instructions"><?php echo e(__('Custom System Instructions')); ?></label>
								  </div>
							   </div>

							   <div class="col-12" id="bexa-system-instructions-field" style="display:none;">
								  <label class="form-label fw-semibold"><?php echo e(__('System Instructions')); ?></label>
								  <textarea name="bexa_system_instructions" class="form-control" rows="3"><?php echo e($device->bexa_system_instructions); ?></textarea>
							   </div>
							</div>
						 </div>
					  </div>
				   </div>
				</div>
            </div>
            <div class="card-footer border-top text-end">
               <button type="submit" class="btn btn-outline-primary btn-sm mt-4 px-4">
                  <i class="ti tabler-check me-1"></i> <?php echo e(__('Save')); ?>

               </button>
            </div>
         </form>
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

<script>
   document.addEventListener('DOMContentLoaded', function () {

      function toggleFields() {
		   const sel = document.querySelector('input[name="typebot"]:checked');
		   const bex = sel && sel.value === '3';

		   document.getElementById('bot-options').style.display =
			 sel && sel.value !== '0' && !bex ? 'block' : 'none';

		   document.getElementById('bexa-options').style.display =
			 bex ? 'block' : 'none';

		   document.getElementById('common-options').style.display =
			 sel && sel.value !== '0' ? 'block' : 'none';

		   toggleBexaCustom();
		   toggleProductFields();
		   toggleSystemInstructions();

		   document.querySelectorAll('.name-field').forEach(el => {
			 el.classList.toggle('d-none', sel.value !== '2');
		   });
		}

      function toggleBexaCustom() {
         const c = document.getElementById('bexa_mode_custom').checked;
         document.getElementById('bexa-custom-fields').style.display = c ? 'flex' : 'none';
      }

      function toggleProductFields() {
         const t = document.querySelector('input[name="bexa_product_input_type"]:checked');
         document.getElementById('bexa-product-link-field').style.display = t && t.value === 'link' ? 'block' : 'none';
         document.getElementById('bexa-products-list').style.display = t && t.value === 'manual' ? 'block' : 'none';
      }

      function toggleSystemInstructions() {
         const s = document.getElementById('bexa_system_custom_instructions').checked;
         document.getElementById('bexa-system-instructions-field').style.display = s ? 'block' : 'none';
      }

      document.querySelectorAll('input[name="typebot"]').forEach(r => r.addEventListener('change', toggleFields));
      document.querySelectorAll('input[name="bexa_mode"]').forEach(r => r.addEventListener('change', toggleBexaCustom));
      document.querySelectorAll('input[name="bexa_product_input_type"]').forEach(r => r.addEventListener('change', toggleProductFields));
      document.getElementById('bexa_system_custom_instructions').addEventListener('change', toggleSystemInstructions);

      document.getElementById('add-product').addEventListener('click', function () {
	   const c = document.getElementById('bexa-products-list');
	   const i = c.querySelectorAll('.product-item').length;
	   const item = document.createElement('div');
	   item.className = 'product-item card border shadow-sm mb-3 rounded';
	   item.innerHTML =
		  '<div class="card-body row g-3 align-items-center">' +
			 '<div class="col-md-4">' +
				'<input type="text" name="bexa_products['+i+'][name]" class="form-control" placeholder="<?php echo e(__('Product Name')); ?>">' +
			 '</div>' +
			 '<div class="col-md-4">' +
				'<input type="text" name="bexa_products['+i+'][description]" class="form-control" placeholder="<?php echo e(__('Description')); ?>">' +
			 '</div>' +
			 '<div class="col-md-3">' +
				'<input type="text" name="bexa_products['+i+'][price]" class="form-control" placeholder="<?php echo e(__('Price')); ?>">' +
			 '</div>' +
			 '<div class="col-md-1 text-end">' +
				'<button type="button" class="btn btn-sm bg-danger-subtle text-danger remove-product"><i class="ti tabler-trash"></i></button>' +
			 '</div>' +
		  '</div>';
	   c.insertBefore(item, document.getElementById('add-product'));
	});

      document.getElementById('bexa-products-list').addEventListener('click', function (e) {
		   const removeBtn = e.target.closest('.remove-product');
		   if (removeBtn) {
			  removeBtn.closest('.product-item').remove();
		   }
		});

      toggleFields();
   });
</script>
<?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/pages/aibot.blade.php ENDPATH**/ ?>