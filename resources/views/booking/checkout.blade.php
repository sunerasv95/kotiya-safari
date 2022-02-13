@extends('layouts.guest')

@section('page-styles')

@endsection

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="display-5 mt-5">Checkout</h3>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-6 offset-md-3">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
            <div class="card border-0 shadow round p-2">
                <div class="card-body">
                    <form id="payAmountForm" action="{{ route('submit-checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="merchant_id" value="1219573">
                    </form>
                    <dl class="row mb-5">
                        <dt class="col-sm-3">Guest Name</dt>
                        <dd class="col-sm-9">SS VIYANGODA</dd>

                        <dt class="col-sm-3">Guest Email</dt>
                        <dd class="col-sm-9">sasasas@app.com</dd>


                        <dt class="col-sm-3">Total</dt>
                        <dd class="col-sm-9">$ 100</dd>
                    </dl>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" form="payAmountForm" class="btn btn-warning btn-lg">Pay Amount ($ 100)</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('page-scripts')

@endsection
