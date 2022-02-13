@extends('layouts.guest')

@section('page-styles')

@endsection

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="display-5 mt-5">Booking Summary</h3>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-6 offset-md-3">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
            <div class="card border-0 shadow round p-2">
                <div class="card-body">
                    <dl class="row mb-5">
                        <dt class="col-sm-3">Name</dt>
                        <dd class="col-sm-9">SS VIYANGODA</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">sasasas@app.com</dd>

                        <dt class="col-sm-3">Check-In </dt>
                        <dd class="col-sm-9">2022-01-01</dd>

                        <dt class="col-sm-3">Check-Out</dt>
                        <dd class="col-sm-9">2022-01-02</dd>

                        <dt class="col-sm-3">Number of Adults</dt>
                        <dd class="col-sm-9">2</dd>

                        <dt class="col-sm-3">Number of Kids</dt>
                        <dd class="col-sm-9">1</dd>
                    </dl>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary btn-lg me-md-2" type="button">Change my Dates</button>
                        <a href="{{ route('checkout-reservation', ['checkoutSessId'=> "4324324fdsfdsfsdf323343432"]) }}"
                            class="btn btn-success btn-lg">
                            Confirm & Checkout
                        </a>
                      </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('page-scripts')

@endsection
