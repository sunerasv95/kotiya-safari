<div class="card shadow p-3 mb-5 border-0 bg-p">
    <img src="{{ asset('dist/images/blog-1.png') }}" 
        class="bg-p--img card-img-top" alt="blog-image">
    <div class="bg-p--body card-body py-3 px-0">
        <h5 class="card-title fw--bolder">{{ $postTitle }}</h5>
        <p class="card-text">{!! $postContent !!}</p>

        <div class="mt-auto bg-p--body-footer">
            <div>
                <p class="card-text">
                    <small class="text-muted">{{ $postPublishedAt }}</small>
                </p>
                <a href="{{ $postRoute }}" class="btn btn-link">Read more..</a>
            </div>
        </div>
        

    </div>
</div>
