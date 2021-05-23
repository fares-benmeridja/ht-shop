<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewpoint" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'ht-shop'))</title>

    <link rel="icon" href="{{ asset('images/logos/logo.png') }}">
    <link href="{{ asset('assets/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">


    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{ route('main') }}">
                            <img src="{{ asset('images/logos/logo.png') }}" width ="100" alt="">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                        </button>
                    </div>
                </div>
            </div>

            @include('admin.includes.navbar')
        </header>

        @include('admin.includes.sidebar')

    <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('admin.includes.header-desktop')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid" id="js-alert">

                        @include('includes.success')
                        @include('includes.error')

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Scripts -->
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
