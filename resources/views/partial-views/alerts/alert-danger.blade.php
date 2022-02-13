@if ($errors->any())
<div class="alert alert-danger alert-dismissible show" role="alert">
    <p class="text-start my-2 py-0"><strong>Error!</strong> Please check the following errors.</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul class="text-start">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('errorMsg'))
@php $message = session()->get('errorMsg'); @endphp
<div class="alert alert-danger alert-dismissible show" role="alert">
    <strong>Error!</strong> {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
