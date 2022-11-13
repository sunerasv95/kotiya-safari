@extends('layouts.admin-auth')

@section('page-styles')
<link href="{{ asset('dist/admin/css/signin.css') }}" rel="stylesheet">
@endsection

@section('main-content')

{{-- <div class="container login-container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            @include('partial-views.alerts.alert-danger')
            @include('partial-views.alerts.alert-success')
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h2 class="display py-2">Login</h2>
            <div class="card border-0 ">
                <div class="card-body">
                    <form
                        id="login-form"
                        method="POST"
                        action="{{ route('admin.login.submit') }}"
                    >
                        @csrf
                        <div class="mb-3 text-start">
                          <label for="username" class="form-label">Email address</label>
                          <input
                            type="email"
                            class="form-control form-control-lg"
                            id="username"
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
                                id="submit-login"
                            >Login</button>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<section class="h-100">
    <header class="container h-100">
      <div class="d-flex align-items-center justify-content-center h-100">
        <div class="d-flex flex-column">
          <h2 class="text align-self-center py-5">Admin Console</h2>

          <div class="card-body">
            <form
                id="login-form"
                method="POST"
                action="{{ route('admin.login.submit') }}"
            >
                @csrf
                <div class="mb-3 text-start">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="email"
                    class="form-control form-control-lg"
                    id="username"
                    name="username"
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
                        id="submit-login"
                    >Login</button>
                  </div>
            </form>
        </div>
        </div>
      </div>
    </header>
  </section>

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).on("click", "#submit-login", function(){
        $("#login-form").validate({
            rules: {
                username: {
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
