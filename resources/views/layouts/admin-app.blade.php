<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title')</title>
    <link href="{{ asset('dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('dist/admin/css/admin-app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body>
    @include('partial-views.navigation.admin-header')
    <div class="d-flex min-vh-100">
        @include('partial-views.navigation.admin-sidebar')
        <div class="w-100 p-5" style="background-color: rgb(236, 240, 241)">
            @yield('main-content')
        </div>
    </div>
    @include('partial-views.modals.signout-modal')

    <!-- Scripts -->
    <script src="{{ asset('dist/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/libs/bootstrap.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('dist/admin/js/admin-app.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
