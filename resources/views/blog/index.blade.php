@extends('layouts.app')

@section('page-styles')

@endsection

@section('page-content')

<div class="container pt-5">
  <div class="p-4 p-md-5 mb-4 text-white rounded"
    style="background-image: url('{{ asset('dist/images/cover/cover_2.jpg')}}');background-repeat: no-repeat;background-attachment: fixed;background-size: cover;opacity:0.9">
    <div class="col-md-6 px-0">
      <h1 class="display-4">{{ $featuredPost['post_title'] }}</h1>
      <p class="lead my-3">{{ $featuredPost['thumbnail_text'] }}</p>
      <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
    </div>
  </div>
</div>

<div class="container">
  <div class="row mb-2">
    <div class="col-md-8">
      @if (!empty($posts))
      @foreach ($posts as $post)
      <div class="row g-0 overflow-hidden flex-md-row mb-4 shadow mb-2 bg-body rounded h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">Wildlife</strong>
          <h3 class="mb-0">{{ $post['post_title'] }}</h3>
          <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($post['published_at'])->isoFormat('MMM Do YY'); }}</div>
          <p class="card-text mb-auto">{!! $post['thumbnail_text'] !!}</p>
          <a href="{{ route('show-blog', ['postSlug'=> $post['post_slug'] ]) }}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="{{ $post['thumbnail_url'] }}" class="img-fluid" alt="{{ $post['post_title'] }}" style="width: 260px;">
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="col-md-5"></div>
  </div>
</div>

@endsection

@section('page-scripts')

@endsection
