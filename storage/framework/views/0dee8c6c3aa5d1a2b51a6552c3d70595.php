<?php if (isset($component)) { $__componentOriginald819fa024fa6d382567c72bcf8897f25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald819fa024fa6d382567c72bcf8897f25 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'theme::components.layout-dashboard','data' => ['title' => ''.e(__('Chat')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout-dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Chat')).'']); ?>
<style>
.chat-message-wrapper { display:flex; flex-direction:column; align-items:flex-start; }
.chat-message-right .chat-message-wrapper { align-items:flex-end; }
.chat-message .chat-message-text { position:relative; }
.reply-action{
  position:absolute;
  top:6px;
  opacity:0;
  transition:opacity .15s;
  cursor:pointer;
  z-index:2;
}
.chat-message:not(.chat-message-right) .reply-action { right:8px; left:auto; }
.chat-message.chat-message-right .reply-action { left:8px; right:auto; }
.chat-message .chat-message-text:hover > .reply-action{ opacity:1; }
.chat-history-footer{ position:relative; }
#reply-preview{
  position: absolute; bottom: 82px; left: 0; right: 0; margin: 0 auto; margin: 1.5rem; z-index: 2;
  display:none;
}
#reply-preview.show{ display:flex; }
.reply-chip{ border-left:3px solid var(--bs-primary); background-color: var(--bs-border-color-translucent); border-radius:8px; align-items:center; }
.chat-message-right .reply-chip{ border-left:3px solid #dfdcdc; }
#reply-preview .me-3{ min-width:0; }
#reply-preview #reply-preview-text{ max-width:100%; }
.avatar .avatar-initial { border:1px solid #c9c9c9; }
.dropdown-toggle::after { content:unset; }
.chat-message-text .reply-chip{ margin: 0 0 .25rem 0; max-width:100%; }
.chat-message-right .reply-action i {background-color: rgb(109, 107, 119);}
.app-chat .app-chat-history .chat-history-body .chat-history .chat-message.chat-message-right .chat-message-text a { color:#fff; }
</style>
<?php if(!session()->has('selectedDevice')): ?>
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center"><?php echo e(__('Please select a device first')); ?></div>
			</div>
		</div>
<?php elseif(session('admin_id')): ?>
		<div class="card shadow-sm border-0">
			<div class="alert alert-danger m-4">
				<div class="text-center"><?php echo e(__('For the privacy, access to the chat has been blocked.')); ?></div>
			</div>
		</div>
<?php else: ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/css/pages/app-chat.css')); ?>?v1120" />

  <div class="app-chat card overflow-hidden">
    <div class="row g-0">

      <div class="col app-chat-sidebar-left app-sidebar overflow-hidden" id="app-chat-sidebar-left">
		  <div class="chat-sidebar-left-user sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-6 pt-12">
			<div class="avatar avatar-xl chat-sidebar-avatar">
			  <span class="avatar-initial rounded-circle bg-label-primary"><?php echo e(substr($deviceId, -2)); ?></span>
			</div>
			<h5 class="mt-4 mb-0">
			  <span id="session-name-text"><?php echo e(auth()->user()->username); ?></span>
			</h5>
			<span><?php echo e($deviceId); ?></span>
			<i class="icon-base ti tabler-x icon-lg cursor-pointer close-sidebar" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-left"></i>
		  </div>

		  <div class="sidebar-body px-6 pb-6">
			<div class="my-6">
			  <p class="text-uppercase text-body-secondary mb-1"><?php echo e(__('Settings')); ?></p>
			  <ul class="list-unstyled d-grid gap-4 ms-2 pt-2 text-heading">
				<li class="d-flex justify-content-between align-items-center">
				  <div>
					<i class="icon-base ti tabler-code-variable-plus icon-md me-1"></i>
					<span class="align-middle"><?php echo e(__('Available')); ?></span>
				  </div>
				  <div class="form-check form-switch mb-0 me-1">
					<input type="checkbox" class="form-check-input" id="switch-available" data-id="<?php echo e($deviceId); ?>" data-url="<?php echo e(route('setAvailable')); ?>" data-key="set_available" <?php echo e(!empty($isAvailable) && $isAvailable ? 'checked' : ''); ?> />
				  </div>
				</li>
				<li class="d-flex justify-content-between align-items-center">
				  <div>
					<i class="icon-base ti tabler-phone-off icon-md me-1"></i>
					<span class="align-middle"><?php echo e(__('Reject Call')); ?></span>
				  </div>
				  <div class="form-check form-switch mb-0 me-1">
					<input type="checkbox" class="form-check-input" id="switch-reject" data-id="<?php echo e($deviceId); ?>" data-url="<?php echo e(route('setHookReject')); ?>" data-key="webhook_reject_call" <?php echo e(!empty($isRejectCall) && $isRejectCall ? 'checked' : ''); ?> />
				  </div>
				</li>
				<li class="d-flex justify-content-between align-items-center">
				  <div>
					<i class="icon-base ti tabler-messages icon-md me-1"></i>
					<span class="align-middle"><?php echo e(__('Messages Read')); ?></span>
				  </div>
				  <div class="form-check form-switch mb-0 me-1">
					<input type="checkbox" class="form-check-input" id="switch-read" data-id="<?php echo e($deviceId); ?>" data-url="<?php echo e(route('setHookRead')); ?>" data-key="webhook_read" <?php echo e(!empty($isMessagesRead) && $isMessagesRead ? 'checked' : ''); ?> />
				  </div>
				</li>
			  </ul>
			</div>
		  </div>
		</div>

      <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
        <div class="sidebar-header h-px-75 px-5 border-bottom d-flex align-items-center">
          <div class="d-flex align-items-center me-6 me-lg-0">
            <div class="flex-shrink-0 avatar avatar-online me-4"
                 data-bs-toggle="sidebar"
                 data-overlay="app-overlay-ex"
                 data-target="#app-chat-sidebar-left">
              <span class="avatar-initial rounded-circle bg-label-primary"><?php echo e(substr($deviceId, -2)); ?></span>
            </div>
            <div class="flex-grow-1 input-group input-group-merge">
              <span class="input-group-text" id="basic-addon-search31">
                <i class="icon-base ti tabler-search icon-xs"></i>
              </span>
              <input type="text"
                     class="form-control chat-search-input"
                     placeholder="<?php echo e(__('Search...')); ?>"
                     aria-label="<?php echo e(__('Search...')); ?>"
                     aria-describedby="basic-addon-search31" />
            </div>
          </div>
          <i class="icon-base ti tabler-x icon-lg cursor-pointer position-absolute top-50 end-0 translate-middle d-lg-none d-block"
             data-overlay
             data-bs-toggle="sidebar"
             data-target="#app-chat-contacts"></i>
        </div>
        <div class="sidebar-body">
          <ul class="list-unstyled chat-contact-list py-2 mb-0" id="chat-list">
            <li class="chat-contact-list-item chat-contact-list-item-title mt-0">
              <h5 class="text-primary mb-0"><?php echo e(__('Chats')); ?></h5>
            </li>
            <li class="chat-contact-list-item chat-list-item-0 d-none">
              <h6 class="text-body-secondary mb-0"><?php echo e(__('No Chats Found')); ?></h6>
            </li>
            <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <li
				class="chat-contact-list-item mb-1"
				data-session-id="<?php echo e($session->id); ?>"
				data-session-body="<?php echo e($session->body ?? ''); ?>"
				data-session-phone="<?php echo e($session->phone_number); ?>"
				data-push-name="<?php echo e($session->push_name ? $session->push_name : $session->phone_number); ?>"
				data-profile-sender="<?php echo e($session->profile_sender ?? ''); ?>"
				data-profile-receive="<?php echo e($session->profile_receive ?? ''); ?>"
				data-stop-ai="<?php echo e($session->stop_ai ?? 0); ?>"
				data-cs-name="<?php echo e($session->cs_name ?? ''); ?>"
			  >
				<a class="d-flex align-items-center">
				  <div class="flex-shrink-0 avatar">
					<?php if(!empty($session->profile_sender)): ?>
						<?php if(\Illuminate\Support\Facades\File::exists(public_path('storage/images/profile/' . basename($session->profile_sender)))): ?>
							<img src="<?php echo e($session->profile_sender); ?>" class="rounded-circle" />
						<?php else: ?>
							<img src="<?php echo e(asset('img/avatars/empty.png')); ?>" class="rounded-circle" />
						<?php endif; ?>
					<?php else: ?>
					  <span class="avatar-initial rounded-circle bg-label-primary">
						<?php echo e(strtoupper(substr($session->phone_number, -2))); ?>

					  </span>
					<?php endif; ?>
				  </div>
				  <div class="chat-contact-info flex-grow-1 ms-4 text-truncate">
					<div class="d-flex justify-content-between align-items-center">
					  <h6 class="chat-contact-name text-truncate m-0 fw-normal">
						<?php echo e($session->push_name ? $session->push_name : $session->phone_number); ?>

					  </h6>
					  <small class="chat-contact-list-item-time">
						<?php echo e($session->updated_at->diffForHumans()); ?>

					  </small>
					</div>
					<small class="chat-contact-status">
					  <?php echo e($session->last_message); ?>

					</small>
				  </div>
				</a>
			  </li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>

      <div class="col app-chat-conversation d-flex align-items-center justify-content-center flex-column" id="app-chat-conversation">
        <div class="bg-label-primary p-8 rounded-circle">
          <i class="icon-base ti tabler-message-2 icon-50px"></i>
        </div>
        <p class="my-4"><?php echo e(__('Select a contact to start a conversation.')); ?></p>
        <button class="btn btn-primary app-chat-conversation-btn" id="app-chat-conversation-btn"><?php echo e(__('Select Contact')); ?></button>
      </div>

      <div class="col app-chat-history d-none" id="app-chat-history">
        <div class="chat-history-wrapper">
          <div class="chat-history-header border-bottom">
            <div class="d-flex justify-content-between align-items-center">
              <div class="d-flex overflow-hidden align-items-center">
                <i class="icon-base ti tabler-menu-2 icon-lg cursor-pointer d-lg-none d-block me-4"
                   data-bs-toggle="sidebar"
                   data-overlay
                   data-target="#app-chat-contacts"></i>
                <div class="flex-shrink-0 avatar" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                  <img src="<?php echo e(asset('img/avatars/1.png')); ?>" alt="<?php echo e(__('Avatar')); ?>" class="rounded-circle" /></a>
                </div>
                <div class="chat-contact-info flex-grow-1 ms-4">
				  <h6 class="m-0 fw-normal"><?php echo e($currentContactName ?? __('Contact')); ?></h6>
				  <small class="user-status text-body"></small>
				</div>
              </div>
              <div class="d-flex align-items-center">
				<span id="ai-toggle-icon" class="btn btn-text-secondary cursor-pointer d-sm-inline-flex d-none me-1 btn-icon rounded-pill">
				  <i class="icon-base ti tabler-ai icon-22px"></i>
				</span>
                <span class="btn btn-text-secondary cursor-pointer d-sm-inline-flex d-none me-1 btn-icon rounded-pill">
                  <i class="icon-base ti tabler-phone icon-22px"></i>
                </span>
                <span class="btn btn-text-secondary cursor-pointer d-sm-inline-flex d-none me-1 btn-icon rounded-pill">
                  <i class="icon-base ti tabler-video icon-22px"></i>
                </span>
                <div class="dropdown">
                  <button class="btn btn-icon btn-text-secondary text-secondary rounded-pill dropdown-toggle hide-arrow"
                          data-bs-toggle="dropdown" aria-expanded="true" id="chat-header-actions">
                    <i class="icon-base ti tabler-dots-vertical icon-22px"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="chat-header-actions">
					  <a class="dropdown-item" id="view-contact" href="javascript:void(0);" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right"><?php echo e(__('View Contact')); ?></a>
					  <a class="dropdown-item" id="change-cs-name" href="javascript:void(0);"><?php echo e(__('Change CS Name')); ?></a>
					  <a class="dropdown-item" id="toggle-ai" href="javascript:void(0);"><?php echo e(__('Stop AI from conversation')); ?></a>
					  <a class="dropdown-item text-danger" id="delete-conversation" href="javascript:void(0);"><?php echo e(__('Delete conversation')); ?></a>
				  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="chat-history-body">
            <ul class="list-unstyled chat-history" id="messages-list"></ul>
          </div>
		  <div>
			  <div id="reply-preview" class="reply-chip rounded p-2 mb-0 align-items-start justify-content-between">
				  <div class="me-3">
					<div class="fw-semibold" id="reply-preview-name"></div>
					<div class="text-truncate" id="reply-preview-text"></div>
				  </div>
				  <button type="button" class="btn btn-text-secondary btn-icon rounded-pill" id="reply-preview-close">
					<i class="icon-base ti tabler-x"></i>
				  </button>
			  </div>
		  </div>
          <div class="chat-history-footer shadow-xs">
            <form class="form-send-message d-flex justify-content-between align-items-center" id="form-send-message">
			  <textarea rows="1" class="form-control message-input border-0 me-4 shadow-none" placeholder="<?php echo e(__('Type your message ...')); ?>" style="line-height:1.5; max-height:3em; overflow:auto; resize:none;"></textarea>
			  <div class="message-actions d-flex align-items-center position-relative">
				<div class="dropdown me-0">
				  <button type="button" class="btn btn-text-secondary btn-icon rounded-pill cursor-pointer dropdown-toggle" id="attach-btn" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="icon-base ti tabler-paperclip icon-22px text-heading"></i>
				  </button>
				  <ul class="dropdown-menu dropdown-menu-end shadow" id="attach-menu">
					<li><a class="dropdown-item d-flex align-items-center" href="#" data-action="document"><i class="icon-base ti tabler-file icon-md me-2"></i> <?php echo e(__('Document')); ?></a></li>
					<li><a class="dropdown-item d-flex align-items-center" href="#" data-action="media"><i class="icon-base ti tabler-photo icon-md me-2"></i> <?php echo e(__('Photos & Videos')); ?></a></li>
					<li><a class="dropdown-item d-flex align-items-center" href="#" data-action="camera"><i class="icon-base ti tabler-camera icon-md me-2"></i> <?php echo e(__('Camera')); ?></a></li>
					<li><a class="dropdown-item d-flex align-items-center" href="#" data-action="audio"><i class="icon-base ti tabler-microphone icon-md me-2"></i> <?php echo e(__('Audio Clip')); ?></a></li>
				  </ul>
				  <input type="file" id="file-input-document" class="d-none" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain,application/zip,application/x-7z-compressed,application/x-rar-compressed">
				  <input type="file" id="file-input-media" class="d-none" accept="image/*,video/mp4,video/3gpp,video/quicktime">
				  <input type="file" id="file-input-camera" class="d-none" accept="image/*" capture="environment">
				  <input type="file" id="file-input-audio" class="d-none" accept="audio/wav,audio/mp3,audio/ogg,audio/aac,audio/mpeg">
				</div>

				<button type="button" class="btn btn-text-secondary btn-icon rounded-pill cursor-pointer ms-0 me-2" id="emoji-btn">
				  <i class="icon-base ti tabler-mood-smile icon-22px text-heading"></i>
				</button>

				<button type="submit" class="btn btn-primary btn-sm d-flex send-msg-btn">
				  <span class="align-middle d-md-inline-block d-none"><?php echo e(__('Send')); ?></span>
				  <i class="icon-base ti tabler-send icon-16px ms-md-2 ms-0"></i>
				</button>
			  </div>
			</form>
          </div>
        </div>
      </div>

      <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
        <div class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap px-6 pt-12">
          <div class="avatar avatar-xl chat-sidebar-avatar">
            <img src="<?php echo e(asset('img/avatars/1.png')); ?>" alt="<?php echo e(__('Avatar')); ?>" class="rounded-circle" />
          </div>
          <h5 class="mt-4 mb-0"><?php echo e($currentContactName ?? __('Contact')); ?></h5>
          <span><?php echo e($currentContactRole ?? __('Online')); ?></span>
          <i class="icon-base ti tabler-x icon-lg cursor-pointer close-sidebar d-block"
             data-bs-toggle="sidebar"
             data-overlay
             data-target="#app-chat-sidebar-right"></i>
        </div>
        <div class="sidebar-body p-6 pt-0">
          <p class="text-uppercase mb-1 text-body-secondary"><?php echo e(__('About')); ?></p>
          <p class="mb-0"><?php echo e($currentContactAbout ?? __('No information available.')); ?></p>
        </div>
      </div>

      <div class="app-overlay"></div>
    </div>
  </div>
<div class="modal fade" id="csNameModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"><?php echo e(__('Change Conversation Name')); ?></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="cs-name-input" placeholder="<?php echo e(__('Custom name')); ?>">
        <small class="text-body-secondary d-block mt-2"><?php echo e(__('Leave it empty if you don’t want to name the conversation.')); ?></small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="save-cs-name"><?php echo e(__('Edit')); ?></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0 position-relative">
      <button type="button"
              class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
              data-bs-dismiss="modal"
              aria-label="Close"></button>
      <div class="modal-body p-0 d-flex justify-content-center">
        <img id="imageModalImg"
             src=""
             class="img-fluid"
             style="max-height: 80vh; width: auto;"
             alt="Preview">
      </div>
    </div>
  </div>
</div>
<div id="emoji-portal" class="d-none" style="position:fixed; z-index:2000;"></div>
<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
<script>
  let Lang = [];
  const NowLang = "<?php echo e(__('Now')); ?>";
  const FetchUrl = "<?php echo e(route('chat.messages', ':id')); ?>";
  Lang['Audio'] = '<?php echo e(__("Audio")); ?>';
  Lang['Video'] = '<?php echo e(__("Video")); ?>';
  Lang['Document'] = '<?php echo e(__("Document")); ?>';
  Lang['Sticker'] = '<?php echo e(__("Sticker")); ?>';
  Lang['Image'] = '<?php echo e(__("Image")); ?>';
  Lang['VCard'] = '<?php echo e(__("VCard")); ?>';
  Lang['Minutes_ago'] = '<?php echo e(__("minutes ago")); ?>';
  Lang['Hours_ago'] = '<?php echo e(__("hours ago")); ?>';
  Lang['Days_ago'] = '<?php echo e(__("days ago")); ?>';
  Lang['DeleteThis'] = '<?php echo e(__("Delete this conversation?")); ?>';
  Lang['StartStopAI'] = '<?php echo e(__("Start/Stop AI updated")); ?>';
  window.currentUserId = <?php echo e(auth()->id()); ?>;
  window.selectedDeviceBody = "<?php echo e(session()->get('selectedDevice')['device_body'] ?? ''); ?>";
  let socket;
  if ('<?php echo e(env('TYPE_SERVER')); ?>' === 'hosting') {
    socket = io();
  } else {
    socket = io('<?php echo e(env('WA_URL_SERVER')); ?>', {
      transports: ['websocket','polling','flashsocket']
    });
  }
  socket.emit('authenticate', { userId: <?php echo e(auth()->id()); ?> });

  var csrfMeta = document.querySelector('meta[name="csrf-token"]');
  var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';

  function postForm(url, formData) {
    return fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: formData });
  }

  function onToggleChange(e) {
    var el = e.target;
    var url = el.getAttribute('data-url');
    var id = el.getAttribute('data-id');
    var val = el.checked ? 1 : 0;
    var fd = new FormData();
    fd.append('id', id);
    fd.append('value', val);
    postForm(url, fd).then(function(r){ return r.ok ? r.json() : Promise.reject(); }).catch(function(){ el.checked = !el.checked; });
  }

  var csrfMeta = document.querySelector('meta[name="csrf-token"]');
  var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
  var notyf = window.notyf || (typeof Notyf !== 'undefined' ? new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } }) : { success: function(){}, error: function(){} });

  function postForm(url, formData) {
    return fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: formData });
  }

  function onToggleChange(e) {
    var el = e.target;
    var url = el.getAttribute('data-url');
    var id = el.getAttribute('data-id');
    var key = el.getAttribute('data-key');
    var val = el.checked ? 1 : 0;
    var fd = new FormData();
    fd.append(key, val);
    fd.append('id', id);
    postForm(url, fd)
      .then(function(r){ return r.json(); })
      .then(function(j){
        if (j && j.error === false) notyf.success(j.msg || 'Updated');
        else {
          notyf.error((j && j.msg) ? j.msg : 'Error');
          el.checked = !el.checked;
        }
      })
      .catch(function(){
        notyf.error('<?php echo e(__("Network error")); ?>');
        el.checked = !el.checked;
      });
  }

  var swAvail = document.getElementById('switch-available');
  var swReject = document.getElementById('switch-reject');
  var swRead = document.getElementById('switch-read');
  if (swAvail) swAvail.addEventListener('change', onToggleChange);
  if (swReject) swReject.addEventListener('change', onToggleChange);
  if (swRead) swRead.addEventListener('change', onToggleChange);

document.addEventListener('DOMContentLoaded', () => {
  var csrfMeta = document.querySelector('meta[name="csrf-token"]');
  var csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';
  var notyf = window.notyf || (typeof Notyf !== 'undefined' ? new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } }) : { success: function(){}, error: function(){} });

  function postForm(url, formData) {
    return fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: formData });
  }

  function onToggleChange(e) {
    var el = e.target;
    var url = el.getAttribute('data-url');
    var id = el.getAttribute('data-id');
    var key = el.getAttribute('data-key');
    var val = el.checked ? 1 : 0;
    var fd = new FormData();
    fd.append(key, val);
    fd.append('id', id);
    postForm(url, fd)
      .then(function(r){ return r.json(); })
      .then(function(j){
        if (j && j.error === false) notyf.success(j.msg || 'Updated');
        else {
          notyf.error((j && j.msg) ? j.msg : 'Error');
          el.checked = !el.checked;
        }
      })
      .catch(function(){
        notyf.error('Network error');
        el.checked = !el.checked;
      });
  }

  var swAvail = document.getElementById('switch-available');
  var swReject = document.getElementById('switch-reject');
  var swRead = document.getElementById('switch-read');
  if (swAvail) swAvail.addEventListener('change', onToggleChange);
  if (swReject) swReject.addEventListener('change', onToggleChange);
  if (swRead) swRead.addEventListener('change', onToggleChange);

  var changeBtn = document.getElementById('change-cs-name');
  var csInput = document.getElementById('cs-name-input');
  var saveBtn = document.getElementById('save-cs-name');
  var modalEl = document.getElementById('csNameModal');
  var bsModal = modalEl ? bootstrap.Modal.getOrCreateInstance(modalEl) : null;

  function currentLi() {
    return window.currentSessionId ? document.querySelector('[data-session-id="' + window.currentSessionId + '"]') : null;
  }

  if (changeBtn && bsModal) {
    changeBtn.addEventListener('click', function(){
      if (!window.currentSessionId) { notyf.error('<?php echo e(__("Select a conversation first")); ?>'); return; }
      var li = currentLi();
      var preset = li ? (li.dataset.csName || '') : '';
      csInput.value = preset;
      bsModal.show();
      setTimeout(function(){ csInput.focus(); }, 120);
    });
  }

  if (saveBtn) {
    saveBtn.addEventListener('click', function(){
      if (!window.currentSessionId) { notyf.error('<?php echo e(__("Select a conversation first")); ?>'); return; }
      var val = csInput.value.trim();
      var fd = new FormData();
      fd.append('session_id', window.currentSessionId);
      fd.append('cs_name', val);
      fetch('<?php echo e(route('chat.session.setName')); ?>', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: fd })
        .then(function(r){ if (!r.ok) throw new Error(); return r.json().catch(function(){ return { ok: true }; }); })
        .then(function(){
		  var li = currentLi();
		  if (li) li.dataset.csName = val || '';
		  if (typeof window !== 'undefined' && String(window.currentSessionId || '') !== '') window.currentCsName = val || '';
		  notyf.success('<?php echo e(__("Conversation name updated")); ?>');
		  bsModal.hide();
		})
        .catch(function(){ notyf.error('<?php echo e(__("Failed to update name")); ?>'); });
    });
  }
});
</script>
<script type="module" src="<?php echo e(asset('js/emoji/picker.min.js')); ?>?v=<?php echo e(config('app.version')); ?>"></script>
<script src="<?php echo e(asset('js/app-chat.js')); ?>?v=<?php echo e(config('app.version')); ?>"></script>
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
<?php /**PATH C:\laragon\www\whatsapp\resources\themes/vuexy/views/pages/chat.blade.php ENDPATH**/ ?>