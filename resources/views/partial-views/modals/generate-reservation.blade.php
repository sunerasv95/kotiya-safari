<x-modal element-name="reservation-generate-modal" size="lg">
    <x-slot name="title">Confirm Reservation</x-slot>
    <form class="pt-1" id="reservation-confirm-form" method="POST"
        action="{{ route('store-reservation-order-request') }}">
        @csrf
        <input type="hidden" name="inquiry_id" value="{{ $inquiryId }}">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <span><i class="bi bi-exclamation-circle"></i></span>
                    Reservation will be genarated according to following details.
                </p>

                @php
                    $chin = \Carbon\Carbon::parse($inquiry['checkin_date']);
                    $chout = \Carbon\Carbon::parse($inquiry['checkout_date']);
                    
                    $nights = $chin->diff($chout)->format('%a');
                @endphp

                <dl class="row">
                    <dt class="col-sm-4">Customer Name</dt>
                    <dd class="col-sm-8">{{ $inquiry['guest']['name'] }}</dd>

                    <dt class="col-sm-4">Check-In </dt>
                    <dd class="col-sm-8">{{ $inquiry['checkin_date'] }}</dd>

                    <dt class="col-sm-4">Check-Out</dt>
                    <dd class="col-sm-8">{{ $inquiry['checkout_date'] }}</dd>

                    <dt class="col-sm-4">Duration</dt>
                    <dd class="col-sm-8">{{ $nights }} Night(s)</dd>

                    
                    <dt class="col-sm-4">Package</dt>
                    <dd class="col-sm-8">Package 01</dd>
                    
                    <dt class="col-sm-4">Packs count</dt>
                    <dd class="col-sm-8">
                        <dl class="row">
                            <dd class="col-sm-12"><strong>Adults -</strong> {{ $inquiry['no_adults']  }} &nbsp;&nbsp; <strong>Kids -</strong> {{ $inquiry['no_kids'] }}</dd>
                        </dl>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-group">
                    <label for="total-amount" class="form-label">Package Amount</label>
                    <input type="number" class="form-control" id="total-amount" name="total_amount" />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="deposit-required" class="form-label">Deposit Required</label>
                    <select class="form-control" id="deposit-required" name="deposit_required">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-group">
                    <label for="deposit-amount" class="form-label">Balance Amount</label>
                    <input type="number" 
                        class="form-control" 
                        id="deposit-amount" 
                        name="deposit_amount" 
                        aria-label="readonly" 
                        data-prev=0
                        readonly 
                    />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="deposit-amount" class="form-label">Deposit Amount</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="deposit-amount" 
                        name="deposit_amount" 
                        data-prev=0
                    />
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-group">
                    <label for="reservation-note" class="form-label">Remark</label>
                    <textarea class="form-control" id="reservation-note" name="reservation_note" rows="3"></textarea>
                </div>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="submit" class="btn btn-success" id="confirm-reservation" form="reservation-confirm-form">
            Confirm
        </button>
    </x-slot>
</x-modal>
