@extends('layouts.master')

@section('title', 'RedArt - Contact us!')

@section('content')
    <!--Start Contact Page-->
    <div class="contact-page">
        <div class="container">
            <h2>Contact us!</h2>
            <form id="form-update" action="{{ route('contact.store') }}" method="POST">
                @csrf
                @guest
                <div class="form-group">
                    <label for="first_name">First name *</label>
                    <input type="text" id="first_name" name="first_name" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="last_name">Last name *</label>
                    <input type="text" id="last_name" name="last_name" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg">
                </div>
                @endguest
                <div class="form-group">
                    <label for="object">Object*</label>
                    <input type="text" name="object" id="object" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="message">Your message*</label>
                    <textarea class="form-control form-control-lg" name="message" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mb-5">Send</button>
            </form>
        </div>
    </div>
    <!--End Contact Page-->
@endsection