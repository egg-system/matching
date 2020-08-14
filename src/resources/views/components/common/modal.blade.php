<div class="modal fade" id="{{ $modal_id }}" tabindex="-1" role="dialog">	
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">	
        <div class="modal-content">	
            <div class="modal-header">	
                <p class="modal-title">{{ $modal_title }}</p>	
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">	
                    <span aria-hidden="true">×</span>	
                </button>	
            </div>	
            <div class="modal-body">	
                {{ $modal_body ?? '' }}	
            </div>	
            @isset($modal_footer)	
            <div class="modal-footer">	
                {{ $modal_footer }}	
            </div>	
            @endisset	
        </div>	
    </div>	
</div>
