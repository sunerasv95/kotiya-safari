@extends('layouts.app')

@section('page-styles')
    <link href="{{ asset('dist/css/blog.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="page-container mt-5 py-5">
        {{-- <x-page-header page-title="Journals"
      sub-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed." /> --}}
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h3 class="fw--bolder fs--larger pt-5 pb-4">Blog Title Goes here</h3>
                <p>Published at <span class="text-muted">2 weeks ago</span> </p>

                <img class="img-fluid" src="{{ asset('dist/images/blog-1.png') }}" alt="" srcset="" height="300">
                <div class="bg-p--content">
                  <p>
                    What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting 
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen 
                    book. It has survived not only five centuries, but also the leap into electronic 
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with 
                    the release of Letraset sheets containing Lorem Ipsum passages, and more recently with 
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem 
                    Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                    galley of type and scrambled it to make a type specimen book. It has survived not only 
                    five centuries, but also the leap into electronic typesetting, remaining essentially 
                    unchanged. It was popularised in the 1960s with the release of Letraset sheets containing 
                    Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
                    PageMaker including versions of Lorem Ipsum.
                  </p>
                  <p>
                    What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting 
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen 
                    book. It has survived not only five centuries, but also the leap into electronic 
                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with 
                    the release of Letraset sheets containing Lorem Ipsum passages, and more recently with 
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem 
                    Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a 
                    galley of type and scrambled it to make a type specimen book. It has survived not only 
                    five centuries, but also the leap into electronic typesetting, remaining essentially 
                    unchanged. It was popularised in the 1960s with the release of Letraset sheets containing 
                    Lorem Ipsum passages, and more recently with desktop publishing software like Aldus 
                    PageMaker including versions of Lorem Ipsum.
                  </p>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
@endsection
