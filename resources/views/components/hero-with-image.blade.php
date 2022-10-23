<div class="row align-items-center g-lg-5 py-5">
    <div class="col-md-6 {{ $col === "reserve" ? 'order-0': 'order-1'}}">
        <h1 class="fw-bold lh-1 mb-3 text--dark-green">{{ $title }}</h1>
        <p class="col-lg-10">
            {{$description}}
        </p>
    </div>
    <div class="col-md-6 {{ $col === "reserve" ? 'order-1': 'order-0'}}">
        <img class="img-fluid" src="{{ $imgUrl }}" 
            alt="services-image" 
        />
    </div>
</div>
