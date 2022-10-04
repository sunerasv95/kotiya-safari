@extends('layouts.app')

@section('page-styles')
@endsection

@section('page-content')
    <div class="page-container mt-5 pt-5">
        <x-page-header page-title="Gallery"
            sub-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed." />

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mb-1 ps-1 pe-0">
                    <div class="card">
                        <img src="{{ asset('dist/images/gallery-1.svg') }}" alt="" srcset="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-1">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-1">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-1 ps-1 pe-1">
                    <div class="card">
                        <img src="{{ asset('dist/images/gallery-1.svg') }}" alt="" srcset="">
                    </div>
                </div>
                <div class="col-md-6 mb-1 ps-1 pe-0">
                    <div class="card">
                        <img src="{{ asset('dist/images/gallery-1.svg') }}" alt="" srcset="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 mb-1 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-1">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-0 ps-1 pe-0">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 ps-1 pe-1">
                            <div class="card">
                                <img src="{{ asset('dist/images/gallery-3.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-scripts')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <script>
        var msnry = new Masonry('.row', {
            itemSelector: '.col',
            percentPosition: true
        });
    </script>
@endsection
