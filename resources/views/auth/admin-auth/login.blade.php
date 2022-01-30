@extends('layouts.admin-auth')

@section('page-styles')
<link href="{{ asset('dist/admin/css/signin.css') }}" rel="stylesheet">
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
@endsection

@section('main-content')
<form
    method="POST"
    action="{{ route('submit-signin') }}"
>
    @csrf
    <img class="mb-4" src="https://i.pinimg.com/474x/aa/22/96/aa229629071d6d0e5612a18577cb6afc.jpg" alt="" width="72"
        height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-success" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
</form>
@endsection

@section('page-scripts')

@endsection
