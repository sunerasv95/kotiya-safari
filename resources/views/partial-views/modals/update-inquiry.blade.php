<x-modal element-name="update-inquiry-modal" size>
    <x-slot name="title">Update Inquiry #{{ $inquiryId }}</x-slot>
    <form id="update-inquiry-form" action="{{ route('admin.inquiries.update.submit') }}" method="POST">
        @csrf
        <input type="hidden" name="inquiry_id" value="{{ $inquiryId }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="update-checkin-date" class="form-label">Check-In</label>
                    <input type="text" class="form-control" id="update-checkin-date" name="up_checkin"
                        value="{{ Carbon\Carbon::parse($inquiry['checkin_date'])->format('m/d/Y')  }}"
                        data-prev="{{ Carbon\Carbon::parse($inquiry['checkin_date'])->format('m/d/Y')  }}"
                    >
                </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                    <label for="update-checkout-date" class="form-label">Check-Out</label>
                    <input type="text" class="form-control" id="update-checkout-date" name="up_checkout"
                        value="{{ Carbon\Carbon::parse($inquiry['checkout_date'])->format('m/d/Y') }}"
                        data-prev="{{ Carbon\Carbon::parse($inquiry['checkout_date'])->format('m/d/Y') }}"
                    >
               </div>
            </div>
        </div>
        <div class=" row mb-3">
            <div class="col-md-6">
               <div class="form-group">
                    <label for="update-no-adults" class="form-label">Number of Adults</label>
                    <input type="number" class="form-control" id="update-no-adults" name="up_no_adults"
                        value="{{ $inquiry['no_adults'] }}" data-prev="{{ $inquiry['no_adults'] }}">
               </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="update-no-kids" class="form-label">Number of Kids</label>
                    <input type="number" class="form-control" id="update-no-kids" name="up_no_kids"
                        value="{{ $inquiry['no_kids'] }}" data-prev="{{ $inquiry['no_kids'] }}">
                </div>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="submit" class="btn btn-warning" id="update-inquiry" 
            form="update-inquiry-form" disabled="disabled">
            Save Changes
        </button>
    </x-slot>
</x-modal>