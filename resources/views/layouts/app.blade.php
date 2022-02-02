<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kotiya Safari</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body>
    <div id="app">
        @include('partial-views.navigation.header')
        <main class="py-4">
            @yield('page-content')
            @include('partial-views.navigation.footer')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
