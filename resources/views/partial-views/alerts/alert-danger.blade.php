@if ($errors->any())
<div class="alert alert-danger alert-dismissible show" role="alert">
    <strong>Error!</strong> Please check the following errors.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
