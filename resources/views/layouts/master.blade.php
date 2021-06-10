<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "icon" href="{{ asset('images/logos/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ht_shop') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>

    @include('client.includes.modals')

    @include('client.includes.navbar')
    <div class="container js-flash">
        @include('includes.success')
        @include('includes.error')
    </div>

    @yield('content')

    @include('client.includes.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/master.js') }}"></script>
    @yield('script')
</body>
</html>
