@extends('layouts.guest')

@section('page-styles')

@endsection

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="display-5 mt-5">Booking Verification</h3>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-4 offset-md-4">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
            <div class="card border-0 shadow round p-2">
                <div class="card-body">
                    <form
                        class="row g-3"
                        id="bookingVerificationForm"
                        method="POST"
                        action="{{ route('submit-verify-reservation') }}"
                    >
                        @csrf
                        <div class="col-md-12">
                            <label for="bkVerificationCode" class="form-label">Booking Verification Code</label>
                            <input type="text" class="form-control form-control-lg" id="bkVerificationCode" name="bkVerificationCode"
                                placeholder="Enter Booking Verification Code">
                            <input type="hidden" name="vfToken" value="{{ Session::get('vftoken') }}">
                        </div>
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" form="bookingVerificationForm"
                                id="verificationSubmitBtn">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
    $(document).on("click", "#verificationSubmitBtn", function(){
        $("#bookingVerificationForm").validate({
            rules: {
                bkVerificationCode: {
                    required: true
                }
            }
        });
    });
</script>

@endsection
