<html lang="en">
    <head>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>XYZ - Blog</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <script src="{{ asset('js/bootstrap.js')}}"></script>
        <script src="{{ asset('js/jquery.min.js')}}"></script>
        @stack('scripts')
    </head>
    <body>
        <br><br>
        <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
            <div class="posts col-11 col-lg-5">
                <div class="container">
                    @yield('content')
                </div>
            </div>
        </div>
        <br><br>
    </body>
</html>
