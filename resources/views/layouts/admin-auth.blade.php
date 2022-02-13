<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Console</title>
    <link href="{{ asset('dist/admin/css/admin-app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body class="text-center">
    <main>
        @yield('main-content')
    </main>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('dist/admin/js/admin-app.js') }}"></script>
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
