@extends('layouts.master')

@section('title', 'RedArt - User')

@section('content')
    <!--Start User Profile-->
    <div class="container">
        <div class="user-profile">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Edit your information</h3>
                    @include('includes.profil-update-form')
                </div>
                <div class="col-lg-6">
                    <h3>Change your password</h3>
                    @include('includes.password-update-form')
                </div>
            </div>
        </div>
    </div>
    <!--End User Profile-->
@endsection
