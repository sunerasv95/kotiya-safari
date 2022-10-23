@extends('layouts.app')

@section('page-styles')
    <link href="{{ asset('dist/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/blog.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="page-container mt-5">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1">
                </button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    {{-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg> --}}
                    <img src="{{ asset('dist/images/slider-1.jpg') }}" class="d-block w-100" alt=""
                        style="object-fit: cover;object-position: top;"
                        >
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class="text-dark">Don't Listen to</h1>
                            <h2 class="text-dark">what they say</h1>
                                <h2 class="text-dark">Come and see!</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> --}}
        </div>

        <section id="home-section-one">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex justify-content-start align-items-start">
                            <img class="pt-2" src="{{ asset('dist/images/icons/note.svg') }}" alt="inquiry-request-icon"
                                width="48">
                            <div class="sec-block px-3">
                                <h4 class="text-white fw--800">Booking Request</h4>
                                <p class="text-white fw-lighter">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has
                                    been the industry's standard</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-start align-items-start">
                            <img class="pt-2" src="{{ asset('dist/images/icons/calender.svg') }}"
                                alt="reservation-inquiry-icon" width="48">
                            <div class="sec-block px-3">
                                <h4 class="text-white fw--800">Check Avaialablity</h4>
                                <p class="text-white fw-lighter">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has
                                    been the industry's standard</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex justify-content-start align-items-start">
                            <img class="pt-2" src="{{ asset('dist/images/icons/happy-face.svg') }}"
                                alt="booking-confirmed-icon" width="48">
                            <div class="sec-block px-3">
                                <h4 class="text-white fw--800">Booking Confirmed</h4>
                                <p class="text-white fw-lighter">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has
                                    been the industry's standard</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="home-section-two">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-block">
                            <h2 class="text--dark-green text-center fw--bold py-4">Leopard Glamping</h2>
                            <p class="text-center">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum
                                nulla. Eu cras augue mi, sed molestie cursus sed. Habitasse vel nibh id consectetur sed est
                                sollicitudin.
                                Dui faucibus metus, suspendisse non. Accumsan volutpat odio vulputate aliquam, non.
                                Amet proin commodo vitae tincidunt eget mauris sit. Dui pulvinar nullam arcu duis. Nisl,
                                risus,
                                pellentesque facilisis sem quam viverra aenean et. Nec eros scelerisque elit id aliquam, et.
                                Sollicitudin
                                vestibulum tristique egestas vel in quam adipiscing commodo, at. Diam posuere mauris
                                fermentum
                                mus tincidunt.
                                Malesuada potenti auctor tristique ac fringilla euismod odio nulla. Amet, consectetur
                                sagittis,
                                vitae id cursus
                                sagittis quisque. Tincidunt lorem neque, sollicitudin sit tincidunt lorem eget.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="home-section-three">
            <div class="container">
                <x-hero-with-image 
                    img-url="{{asset('dist/images/service-img-1.svg') }}"
                    title="Super Luxury Camping"
                    description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed. Habitasse vel nibh id consectetur sed est sollicitudin. Dui faucibus metus, suspendisse non. Accumsan volutpat odio vulputate aliquam, non. Amet proin commodo vitae tincidunt eget mauris sit. Dui pulvinar nullam arcu duis. Nisl, risus, pellentesque facilisis sem quam viverra aenean et. Nec eros scelerisque elit id aliquam, et. Sollicitudin vestibulum tristique egestas vel in quam adipiscing commodo, at. Diam posuere mauris fermentum mus tincidunt. Malesuada potenti auctor tristique ac fringilla euismod odio nulla. Amet, consectetur sagittis, vitae id cursus sagittis quisque. Tincidunt lorem neque, sollicitudin sit tincidunt lorem eget."
                    col="reverse"
                />

                <x-hero-with-image 
                    img-url="{{ asset('dist/images/service-img-2.svg') }}"
                    title="In to the Wild"
                    description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed. Habitasse vel nibh id consectetur sed est sollicitudin. Dui faucibus metus, suspendisse non. Accumsan volutpat odio vulputate aliquam, non. Amet proin commodo vitae tincidunt eget mauris sit. Dui pulvinar nullam arcu duis. Nisl, risus, pellentesque facilisis sem quam viverra aenean et. Nec eros scelerisque elit id aliquam, et. Sollicitudin vestibulum tristique egestas vel in quam adipiscing commodo, at. Diam posuere mauris fermentum mus tincidunt. Malesuada potenti auctor tristique ac fringilla euismod odio nulla. Amet, consectetur sagittis, vitae id cursus sagittis quisque. Tincidunt lorem neque, sollicitudin sit tincidunt lorem eget."                
                />
            </div>
        </section>

        <section id="home-backdrop">
            <div class="position-relative overflow-hidden text-center">
                <div class="col-md-8 p-lg-5 mx-auto my-5">
                    <h1 class="display-4 fw-norma text-white">Don't listen what they say<br>Come See!</h1>
                    <a class="btn btn-silver text-white btn-lg mt-5" href="{{ route('guest.packages') }}">See Packages & Rates</a>
                </div>
                <div class="product-device shadow-sm d-none d-md-block"></div>
                <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
            </div>
        </section>

        <section id="home-blog-list">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <x-blog-post 
                            post-title="Cardtitle"
                            post-content="This is a wider card with supporting text below as a natural lead-into additional content. This content is a little bit longer."
                            post-thumbnail="{{ asset('dist/images/blog-1.png') }}"
                            post-published-at="Last updated 3 mins ago"
                            post-route="{{route('guest.blogs.show', ['postSlug' => 'sadsadas'])}}"
                        />
                    </div>
                    <div class="col">
                        <x-blog-post 
                            post-title="Card title"
                            post-content="This is a wider card with supporting text below as a natural lead-into additional content. This content is a little bit longer."
                            post-thumbnail="{{ asset('dist/images/blog-1.png') }}"
                            post-published-at="Last updated 3 mins ago"
                            post-route="{{route('guest.blogs.show', ['postSlug' => 'sadsadas'])}}"
                        />
                    </div>
                    <div class="col">
                        <x-blog-post 
                            post-title="Card title"
                            post-content="This is a wider card with supporting text below as a natural lead-into additional content. This content is a little bit longer."
                            post-thumbnail="{{ asset('dist/images/blog-1.png') }}"
                            post-published-at="Last updated 3 mins ago"
                            post-route="{{route('guest.blogs.show', ['postSlug' => 'sadsadas'])}}"
                        />
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col">
                        <div class="mx-auto" style="width: 200px;">
                            <button type="button" class="btn btn-link fs--regular text--baige">Read more Journals</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-scripts')
@endsection
