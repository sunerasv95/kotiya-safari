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
        <main>
            @yield('page-content')
            <div class="bg--gray">
                @include('partial-views.navigation.footer')
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(() => {
            //    console.log("test", $(".alert-danger").hasClass("show"));
               if($(".alert-danger").hasClass("show")){
                    $(".alert-danger").removeClass("show").addClass("fade").remove();
               }
               if($(".alert-success").hasClass("show")){
                    $(".alert-success").removeClass("show").addClass("fade").remove();
               }
            }, 5000);
        });
    </script>
    @yield('page-scripts')
</body>

</html>
