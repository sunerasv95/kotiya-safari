@extends('layouts.app')

@section('page-styles')
    <link href="{{ asset('dist/css/information.css') }}" rel="stylesheet">
@endsection

@section('page-content')
    <div class="page-container mt-5 pt-5">
        <x-page-header page-title="YALA (Ruhuna) National Park"
            sub-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed." />

        <div class="container">
            <div class="banner"
                style="height: 225px;
                width:100%;
                background-image: url('{{ asset('dist/images/banner-img-1.svg') }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: scroll;
                background-position: inherit;">
            </div>
            <figure class="text-center mt-2 py-3">
                <blockquote class="blockquote">
                    <p class="fs--800" style="font-size: 1.5rem">"Leave the roads; take the trails."</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite title="Source Title">Pythagoras</cite>
                </figcaption>
            </figure>
            <div class="container py-5">
               <x-hero.hero-with-image 
                img-url="{{asset('dist/images/infor-img-3.svg')}}"
                title="In to the Wild"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed. Habitasse vel nibh id consectetur sed est sollicitudin. Dui faucibus metus, suspendisse non. Accumsan volutpat odio vulputate aliquam, non. Amet proin commodo vitae tincidunt eget mauris sit. Dui pulvinar nullam arcu duis. Nisl, risus, pellentesque facilisis sem quam viverra aenean et. Nec eros scelerisque elit id aliquam, et. Sollicitudin vestibulum tristique egestas vel in quam adipiscing commodo, at. Diam posuere mauris fermentum mus tincidunt. Malesuada potenti auctor tristique ac fringilla euismod odio nulla. Amet, consectetur sagittis, vitae id cursus sagittis quisque. Tincidunt lorem neque, sollicitudin sit tincidunt lorem eget."
                />
                <x-hero.hero-with-image 
                img-url="{{asset('dist/images/infor-img-3.svg')}}"
                title="In to the Wild"
                description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed. Habitasse vel nibh id consectetur sed est sollicitudin. Dui faucibus metus, suspendisse non. Accumsan volutpat odio vulputate aliquam, non. Amet proin commodo vitae tincidunt eget mauris sit. Dui pulvinar nullam arcu duis. Nisl, risus, pellentesque facilisis sem quam viverra aenean et. Nec eros scelerisque elit id aliquam, et. Sollicitudin vestibulum tristique egestas vel in quam adipiscing commodo, at. Diam posuere mauris fermentum mus tincidunt. Malesuada potenti auctor tristique ac fringilla euismod odio nulla. Amet, consectetur sagittis, vitae id cursus sagittis quisque. Tincidunt lorem neque, sollicitudin sit tincidunt lorem eget."
                col="reverse"
                />
            </div>
        </div>
        <div class="bg-dark text-secondary" style="height: auto;">
            <div class="container py-3">
                <div class="row g-lg-5 py-2">
                    <div class="col-md-6">
                        <dl class="row align-items-start px-3">
                            <dt class="col-sm-5">Total Land Area</dt>
                            <dd class="col-sm-7">97,880 hectares (378 sq.mi)</dd>
                          
                            <dt class="col-sm-5">Block I Land Area</dt>
                            <dd class="col-sm-7">14,101 hectares (54 sq.mi)</dd>
                          
                            <dt class="col-sm-5">Species of Individual Mammals Recorded</dt>
                            <dd class="col-sm-7">44</dd>
                          
                            <dt class="col-sm-5">Species of Individual Birds Recorded</dt>
                            <dd class="col-sm-7">215</dd>
                          
                            <dt class="col-sm-5">Avg. Annual Rainfall</dt>
                            <dd class="col-sm-7">500-775mm</dd>

                            <dt class="col-sm-5">Monsoon</dt>
                            <dd class="col-sm-7">October - January</dd>

                            <dt class="col-sm-5">Climate</dt>
                            <dd class="col-sm-7">Semi arid</dd>

                            <dt class="col-sm-5">Ecological Diversity</dt>
                            <dd class="col-sm-7">
                                Moist & dry monsoon forests, Semi deciduous forests, 
                                thorn forests, grasslands, fresh and brackish water 
                                wetlands, and sand dunes
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <img class="img-fluid" src="{{ asset('dist/images/infor-img-3.svg') }}" alt="services-image" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-scripts')
@endsection
