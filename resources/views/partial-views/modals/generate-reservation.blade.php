<x-modal element-name="reservation-generate-modal" size="lg">
    <x-slot name="title">Confirm Reservation</x-slot>
    <form class="pt-1" id="reservation-confirm-form" method="POST"
        action="{{ route('store-reservation-order-request') }}">
        @csrf
        <input type="hidden" name="inquiry_id" value="{{ $inquiryId }}">
        <div class="row">
            <div class="col-md-6">
                <p>
                    <span><i class="bi bi-exclamation-circle"></i></span>
                    Reservation will be genarated according for following inquiry.
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
                            <dd class="col-sm-12">
                                <strong>Adults -</strong> {{ $inquiry['no_adults']  }} &nbsp;&nbsp; 
                                <strong>Kids -</strong> {{ $inquiry['no_kids'] }}
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <label for="payment-option" class="form-label">Add Payment</label>
                    <select class="form-control" 
                        id="payment-option" 
                        name="payment_option"
                    >
                        <option value selected>-- Select payment option --</option>
                        @foreach ($payOptions as $opt)
                            <option value="{{ $opt['pay_option_code'] }}">{{ $opt['pay_option_name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label for="payable-amount" class="form-label">Amount</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="payable-amount" 
                        name="payable_amount" 
                        data-prev=0
                    />
                </div>
                <div class="form-group mb-2">
                    <label for="reservation-note" class="form-label">Remarks</label>
                    <textarea class="form-control" 
                        id="reservation-note" 
                        name="reservation_note" 
                        rows="3"></textarea>
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



{{-- <x-modal element-name="reservation-generate-modal" size="lg">
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
                    <dt class="col-sm-3">Customer Name</dt>
                    <dd class="col-sm-9">{{ $inquiry['guest']['name'] }}</dd>

                    <dt class="col-sm-3">Check-In </dt>
                    <dd class="col-sm-9">{{ $inquiry['checkin_date'] }}</dd>

                    <dt class="col-sm-3">Check-Out</dt>
                    <dd class="col-sm-9">{{ $inquiry['checkout_date'] }}</dd>

                    <dt class="col-sm-3">Duration</dt>
                    <dd class="col-sm-9">{{ $nights }} Night(s)</dd>

                    
                    <dt class="col-sm-3">Package</dt>
                    <dd class="col-sm-9">Package 01</dd>
                    
                    <dt class="col-sm-3">Packs count</dt>
                    <dd class="col-sm-9">
                        <dl class="row">
                            <dd class="col-sm-12">
                                <strong>Adults -</strong> {{ $inquiry['no_adults']  }} &nbsp;&nbsp; 
                                <strong>Kids -</strong> {{ $inquiry['no_kids'] }}
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <div class="form-group">
                    <label for="payment-option" class="form-label">Payment Option</label>
                    <select class="form-control" 
                        id="payment-option" 
                        name="payment_option"
                    >
                        <option value>-- Select payment option --</option>
                        <option value="1">Pre-Payment Required</option>
                        <option value="2">Full Payment Required</option>
                        <option value="3">Pay At Property</option>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="amount" class="form-label">Amount</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="amount" 
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
                    <textarea class="form-control" 
                        id="reservation-note" 
                        name="reservation_note" 
                        rows="3"></textarea>
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
</x-modal> --}}
