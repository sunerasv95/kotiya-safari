@if (session()->has('successMsg'))
@php $message = session()->get('successMsg'); @endphp
<div class="alert alert-success alert-dismissible show" role="alert">
    <strong>Success!</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
