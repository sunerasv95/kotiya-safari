<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('page-title')

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">

    <!-- Styles -->
    <link href="{{ asset('dist/admin/css/admin-app.css') }}" rel="stylesheet">
    @yield('page-styles')
</head>

<body>
    @include('partial-views.navigation.admin-header')
    <div class="container-fluid">
        <div class="row">
            @include('partial-views.navigation.admin-sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('main-content')
            </main>
        </div>
    </div>
    @include('partial-views.navigation.admin-footer')

    <!-- Sign out confirmation modal -->
    <div class="modal fade" tabindex="-1" id="signedOutConfirmation">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><strong>Confirmation</strong></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure to sign-out?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <a href="{{ route('submit-signout') }}" class="btn btn-danger">Yes, Sign me Out</a>
            </div>
          </div>
        </div>
      </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('dist/admin/js/admin-app.js') }}"></script>
    <script>
        $(document).ready(function(){
            setTimeout(() => {
            console.log("test", $(".alert-danger").hasClass("show"));
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
