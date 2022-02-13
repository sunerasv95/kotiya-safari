@extends('layouts.admin-auth')

@section('page-styles')
<link href="{{ asset('dist/admin/css/signin.css') }}" rel="stylesheet">
@endsection

@section('main-content')

<div class="container login-container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="display py-2">Login</h2>
            <div class="card">
                <div class="card-body">
                    <form
                        id="loginForm"
                        method="POST"
                        action="{{ route('submit-signin') }}"
                    >
                        @csrf
                        <div class="mb-3 text-start">
                          <label for="emailId" class="form-label">Email address</label>
                          <input
                            type="email"
                            class="form-control form-control-lg"
                            id="emailId"
                            name="email"
                        >
                        </div>
                        <div class="mb-3 text-start">
                          <label for="password" class="form-label">Password</label>
                          <input
                            type="password"
                            class="form-control form-control-lg"
                            id="password"
                            name="password"
                        >
                        </div>
                        <div class="d-grid gap-2">
                            <button
                                class="btn btn-primary btn-lg"
                                type="submit"
                                id="loginBtn"
                            >Login</button>
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
    $(document).on("click", "#loginBtn", function(){
        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            }
        });
    });
</script>
@endsection
