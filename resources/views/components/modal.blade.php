<!-- Modal -->
<div 
  class="modal fade" 
  id="{{ $elementName }}" 
  tabindex="-1" 
  aria-labelledby="{{ $elementName }}-label" 
  aria-hidden="true"
>
    <div {{ $attributes->class([
      "modal-dialog",
      "modal-lg" => $size === "lg" ? true : false 
    ]) }}
      
    >
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><strong>{{ $title }}</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
          {{ $footer }}
        </div>
      </div>
    </div>
  </div>