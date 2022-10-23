@extends('layouts.centered-content')

@section('page-styles')
@endsection

@section('page-content')
<div class="container">
  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-5" src="{{ asset('dist/images/logo-full.svg') }}" alt="" >
    <h1 class="display-5 fw-bold">Thank you for joining with us!</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-5">Your inquiry has recieved. Please check your email for more.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="{{ route('guest.home') }}" class="btn btn-cs-baige btn-lg px-4 gap-3">Back to home</a>
        <a href="{{ route('guest.blogs') }}" class="btn btn-outline-secondary btn-lg px-4">Read our journal</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('page-scripts')

@endsection
