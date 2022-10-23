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
        @include('partial-views.navigation.header')
        <main>
            @yield('page-content')
            <div class="bg--gray">
                @include('partial-views.navigation.footer')
            </div>
        </main>
    </div>
    @include('partial-views.modals.reservation-inquiry')
    {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="crossorigin="anonymous"></script> --}}
    <script src="{{ asset('dist/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{asset('dist/js/plugins/jquery.validate.min.js')}}" type="text/javascript"></script>
    @yield('page-scripts')
</body>

</html>
