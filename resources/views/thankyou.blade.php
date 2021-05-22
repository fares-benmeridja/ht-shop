@extends('layouts.master')

@section('title', 'thankyou')

@section('content')
    <div class="row" style="justify-content: center; align-items: center; min-height: 32.5vh">
        <div class="col-md-8">
            <h1 class="text-center my-4" style="background-color: #140c4c; color: white">Thank you !</h1>
                <p class="text-center">Your order is being processed, we'll contact you soon.</p>
                <p class="text-center">Your invoice : <a href="{{ route('invoice.download', $order) }}">Click me</a></p>
            <hr class="my-2" style="background-color:#140c4c;">
            <p class="text-center">Contact us : <a href="{{ route('contact.create') }}">Nous contacter</a></p>
        </div>
    </div>
@endsection