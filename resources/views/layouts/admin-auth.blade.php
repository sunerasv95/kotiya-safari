<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Console</title>
    <link href="{{ asset('dist/admin/css/admin-app.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }
    </style>
    @yield('page-styles')
</head>

<body class="text-center">
    <main class="form-signin">
        @yield('main-content')
    </main>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('dist/admin/js/admin-app.js') }}"></script>
    @yield('page-scripts')
</body>

</html>
