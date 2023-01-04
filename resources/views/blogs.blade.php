@extends('layouts.app')

@section('page-styles')
    <link href="{{ asset('dist/css/blog.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="page-container mt-5 py-5">
        <x-page-header page-title="Journals"
            sub-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed." />

        <div class="container">
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-md-4">
                        <x-blog-post :post-title="$post['post_title']" :post-content="$post['post_slug']" :post-thumbnail="$post['thumbnail_url']" :post-published-at="$post['published_at']"
                            :post-route="route('guest.blogs.show', ['postSlug' => $post['post_slug']])" />
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center py-5">No Posts found!</p>
                    </div>
                @endforelse
            </div>

            @if (!empty($posts))
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center py-5 mx-auto">
                            <button class="btn btn-link fs--regular">Load more posts..</button>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection

@section('page-scripts')
@endsection
