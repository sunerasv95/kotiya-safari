<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Leopard Glamping</title>
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body>
    <div id="app">
        <main class="h-100 d-flex justify-content-center align-items-center">
            @yield('page-content')
        </main>
    </div>
    <script src="{{ asset('dist/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    @yield('page-scripts')
</body>
</html>
