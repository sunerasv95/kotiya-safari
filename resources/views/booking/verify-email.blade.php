@extends('layouts.guest')

@section('page-styles')

@endsection

@section('page-content')
<div class="container pt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3 class="display-5 mt-5">Email Verification</h3>
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
                        id="emailVerificationForm"
                        method="POST"
                        action="{{ route('submit-verify-email') }}"
                    >
                        @csrf
                        <div class="col-md-12">
                            <label for="email" class="form-label">Enter your Email</label>
                            <input type="email" class=" form-control form-control-lg" id="email" name="verifyEmail"
                                placeholder="example@app.com" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Note: Please enter same email which you provided for the reservation.</div>
                        </div>
                        <div class="d-grid mt-2">
                            <button type="submit" class="btn btn-warning btn-lg btn-block" form="emailVerificationForm"
                                id="emailSubmitBtn">Continue</button>
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
    $(document).on("click", "#emailSubmitBtn", function(){
        $("#emailVerificationForm").validate({
            rules: {
                verifyEmail: {
                    required: true,
                    email: true
                }
            }
        });
    });
</script>

@endsection
