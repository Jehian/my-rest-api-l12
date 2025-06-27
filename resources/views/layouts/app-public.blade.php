<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) ?? 'en' }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('app.desc') }}">
    <meta name="keywords" content="ecommerce,book">
    <meta name="author" content="{{ config('app.name') }}">

    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- BEGIN: CSS Assets -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor/linearicons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/animation.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/easyzoom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    @yield('addition_css')
    <!-- END: CSS Assets -->
</head>
<body class="box-home">
    <div class="page-box">
        @include('components.header')
        <div id="main-wrapper">
            @yield('content')
            @include('components.footer')
        </div>
    </div>

    <!-- BEGIN: JS Assets -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/axios.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fullpage.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/easyzoom.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/images-loaded.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/YTplayer.js') }}"></script>
    
    <!-- Instagramfeed JS -->
    <!-- <script src="{{ asset('assets/js/plugins/jquery.instagramfeed.min.js')}}"></script> -->
    <script src="{{ asset('assets/js/plugins/ajax.mail.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.min.js')}}"></script>
    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load 
    performance and remove plugin js files from above) -->
    <script src="{{ asset('assets/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('pages/js/app.js') }}"></script>
    @yield('addition_script')
    <!-- END: JS Assets -->
</body>
</html>
