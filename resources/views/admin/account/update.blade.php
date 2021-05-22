@extends('layouts.admin')

@section('title', 'Account')

@section('content')
    <div class="container">
        <div class="user-profile">
            <div class="row">
                <div class="col-lg-6">
                    <h3 style="margin-bottom: 15px;">Edit your information</h3>
                    @include('includes.profil-update-form')
                </div>
                <div class="col-lg-6">
                    <h3 style="margin-bottom: 15px;">Change your password</h3>
                    @include('includes.password-update-form')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection