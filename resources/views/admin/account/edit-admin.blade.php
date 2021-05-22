@extends('layouts.admin')

@section('title', 'Edit admin')

@section('content')
    <div class="container">
        <div class="user-profile">
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="margin-bottom: 15px;">{{ $title }}</h3>
                    @include('admin.account.__form')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection