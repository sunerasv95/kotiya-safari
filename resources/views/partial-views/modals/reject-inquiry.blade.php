<!-- Reject inquiry modal -->
{{-- <div class="modal fade" tabindex="-1" id="inquiry-reject-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Confirmation</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This action can not be un-done. Are you sure to reject this inquiry?</p>
                <form id="inquiry-reject-form" method="POST" action="{{ route('admin.inquiries.reject.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="msg-body" class="col-form-label">Reject Reason</label>
                        <textarea class="form-control" id="msg-body" name="msg_body"></textarea>
                    </div>
                    <input type="hidden" name="inquiry_id" value="{{ $inquiry['inquiry_reference_no'] }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="reject-inquiry"
                    form="inquiry-reject-form">Yes, Reject this Inquiry</button>
            </div>
        </div>
    </div>
</div> --}}

<x-modal element-name="inquiry-reject-modal" size>
    <x-slot name="title">Confirm Action</x-slot>
    <p>This action can not be un-done. Are you sure to reject this inquiry? </p>
    <form id="inquiry-reject-form" method="POST" action="{{ route('admin.inquiries.reject.submit') }}">
        @csrf
        <div class="mb-3">
            <label for="msg-body" class="col-form-label">Reject Reason</label>
            <textarea class="form-control" id="msg-body" name="msg_body"></textarea>
        </div>
        <input type="hidden" name="inquiry_id" value="{{ $inquiry['inquiry_reference_no'] }}">
    </form>
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancel</button>
        <button type="submit" class="btn btn-danger" id="reject-inquiry"
            form="inquiry-reject-form" disabled="disabled">
            Yes, Reject this Inquiry
        </button>
    </x-slot>
</x-modal>
