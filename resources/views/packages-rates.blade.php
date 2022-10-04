@extends('layouts.app')

@section('page-styles')
<link rel="stylesheet" href="{{ asset('dist/css/packages.css') }}">
@endsection

@section('page-content')
    <div class="page-container mt-5 py-5">
        <x-page-header page-title="Packages & Rates"
            sub-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed." />

        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 p-3 shadow p-3 mb-5 rounded border-0 pack">
                        <div class="card-body">
                            <h4 class="pack--name">Package 01</h4>
                            <h4 class="pack--price-tag">USD. 200</h4>
                            <ul class="mt-3 mb-4 ms-0 ps-3 pack--list">
                                <li>Accomodation</li>
                                <li>All Meals</li>
                                <li>All Beverages</li>
                                <li>Park Entry</li>
                                <li>Pick-up & Drop-off</li>
                            </ul>
                            <p class="text-start text-dark pack--desc">
                                <small>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue
                                    sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed
                                </small>
                            </p>
                            <button type="button" class="w-100 btn btn-lg bg--baige text-white">
                                Online Reservation
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 p-3 shadow p-3 mb-5 rounded border-0 pack">
                        <div class="card-body">
                            <h4 class="pack--name">Package 02</h4>
                            <h4 class="pack--price-tag">USD. 400</h4>
                            <ul class="mt-3 mb-4 ms-0 ps-3 pack--list">
                                <li>Accomodation</li>
                                <li>All Meals</li>
                                <li>All Beverages</li>
                                <li>Park Entry</li>
                                <li>Pick-up & Drop-off</li>
                            </ul>
                            <p class="text-start text-dark pack--desc">
                                <small>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue
                                    sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed
                                </small>
                            </p>
                            <button type="button" class="w-100 btn btn-lg bg--baige text-white">
                                Online Reservation
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 p-3 shadow p-3 mb-5 rounded border-0 pack">
                        <div class="card-body">
                            <h4 class="pack--name">Package 03</h4>
                            <h4 class="pack--price-tag">USD. 800</h4>
                            <ul class="mt-3 mb-4 ms-0 ps-3 pack--list">
                                <li>Accomodation</li>
                                <li>All Meals</li>
                                <li>All Beverages</li>
                                <li>Park Entry</li>
                                <li>Pick-up & Drop-off</li>
                            </ul>
                            <p class="text-start text-dark pack--desc">
                                <small>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sapien augue
                                    sit orci, vestibulum nulla. Eu cras augue mi, sed molestie cursus sed
                                </small>
                            </p>
                            <button type="button" class="w-100 btn btn-lg bg--baige text-white">
                                Online Reservation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="fs--regular text-dark">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                        standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to 
                        make a type specimen book. It has survived not only five centuries.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        // $(".card")
        //     .mouseover(function() {
        //        $(this).addClass('bg-dark');
        //        //console.log('loooogggggg');
        //     })
        //     .mouseout(function(){
        //         $(this).hasClass('bg-dark') ? $(this).removeClass('bg-dark') : '';
        //     })
    </script>
@endsection
