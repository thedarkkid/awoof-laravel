<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- FONTS ONLINE -->
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!--MAIN STYLE-->
    <link href="{{ asset('assets/sebian/') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sebian/') }}/css/main.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sebian/') }}/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sebian/') }}/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sebian/') }}/css/animate.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/sebian/') }}/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- ADD YOUR OWN STYLING HERE. AVOID TO USE STYLE.CSS AND MAIN.CSS. IT WILL BE HELPFUL FOR YOU IN FUTURE UPDATES -->
    <link href="{{ asset('assets/sebian/') }}/css/custom.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/sebian/') }}/rs-plugin/css/settings.css" media="screen" />

    <!-- JavaScripts -->
    <script src="{{ asset('assets/sebian/') }}/js/modernizr.js"></script>
    <script src="{{ asset('assets/sebian/') }}/js/jquery-1.11.3.js"></script>
    @yield('headscripts')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
@yield('extrastyles')

@yield('preloader')

<!-- Page Wrap -->
<div id="wrap">

    <!-- Header -->
    <header class="header-style-2">
        @yield('topbar')

        <div class="container">
            <div class="logo">
                <a href="{{route('user.home')}}" class="text-uppercase h1"> AWOOF</a>
{{--                <a href="index.html"><img src="{{ asset('assets/sebian/') }}/images/logo.png" alt="AWOOF"></a> --}}
            </div>
        </div>

        @yield('navbar', View::make('layouts.navbar'))
    </header>
    <!-- Header End -->

    @yield('slider')

    <!-- CONTENT START -->
    <div class="content min-vh-49 mt-vh-5 mb-vh-5">
        @include('layouts.flash-message');
        @yield('content')
    </div>

    @yield('footer', View::make('layouts.footer'))
    <!--======= Footer =========-->
    <!-- GO TO TOP -->
    <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a>
    <!-- GO TO TOP End -->
</div>
<!-- Wrap End -->
    <script src="{{ asset('assets/sebian/') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/sebian/') }}/js/own-menu.js"></script>
    @yield('extrascripts')
</body>
</html>
