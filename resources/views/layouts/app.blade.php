<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Leopard Glamping</title>

    <link href="{{ asset('dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body>
    <div id="app">
        @include('partial-views.navigation.header')
        <main>
            @yield('page-content')
            <div class="bg--gray">
                @include('partial-views.navigation.footer')
            </div>
        </main>
    </div>
    @include('partial-views.modals.reservation-inquiry')
    <script src="{{ asset('dist/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/libs/bootstrap.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
