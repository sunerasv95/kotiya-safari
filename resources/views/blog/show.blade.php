@extends('layouts.app')

@section('page-styles')
<link href="{{ asset('dist/css/blog.css') }}" rel="stylesheet">
@endsection

@section('page-content')

<div class="container pt-5">
  <div class="blog-cover-img p-4 p-md-5 mb-4 text-white"
    style="background-image: url('{{ $post['thumbnail_url'] }}');">
  </div>
</div>

<div class="container">
  <div class="row mb-2">
    <div class="col-md-8 offset-md-2">
        <section id="publishingDetails">
            <div class="d-flex align-items-center">
                <img
                    class="blog-author-avatar rounded-circle mr-2"
                    src="{{  asset('dist/images/people/person_2.jpg') }}"
                    alt="author_image">
                <div class="d-flex flex-column justify-content-start">
                    <h4>{{ Auth::user()->name ?? 'Anne Marie'}}</h4>
                    <span>{{ \Carbon\Carbon::parse($post['published_at'])->isoFormat('MMM Do YY'); }}</span>
                </div>
            </div>
        </section>
        <section id="postTitle">
            <h1 class="blog-title">{{ $post['post_title'] }}</h3>
        </section>
        <section id="postBody">
            <p class="blog-content-text">{!! $post['post_content'] !!}</p>
        </section>
    </div>
  </div>
</div>

@endsection

@section('page-scripts')

@endsection
