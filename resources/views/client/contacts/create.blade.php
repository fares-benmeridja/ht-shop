@extends('layouts.master')

@section('title', 'Ht-shop - Contact us!')

@section('content')
    <!--Start Contact Page-->
    <div class="contact-page">
        <div class="container">
            <h2>Contact us!</h2>
            <form id="form-update" action="{{ route('contact.store') }}" method="POST">
                @csrf
                @guest
                <div class="form-group">
                    <label for="email" class="required">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg">
                </div>
                @endguest
                <div class="form-group">
                    <label for="object" class="required">Object</label>
                    <input type="text" name="object" id="object" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="message" class="required">Your message</label>
                    <textarea class="form-control form-control-lg" name="message" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg mb-5">Send</button>
            </form>
        </div>
    </div>
    <!--End Contact Page-->
@endsection