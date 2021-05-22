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

    <title>{{ config('app.name', 'RedArt') }}</title>

    <link href="{{ asset('assets/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">


    <!-- Styles -->
    <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
</head>

<body class="animsition">
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{ asset('images/logo.png') }}" width ="150px" alt="">
                        </a>
                    </div>
                    <div class="login-form">
                        <form id="sign-in" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input class="au-input au-input--full @error('email') is-invalid @enderror" placeholder="Email" id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" autocomplete="current-password" class="au-input au-input--full @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="login-checkbox">
                                <label class="form-check-label" for="remember">
                                    <input type="checkbox" name="remember"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Remember Me') }}
                                </label>
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">{{ __('Sign in') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ mix('js/admin.js') }}"></script>
</body>
</html>