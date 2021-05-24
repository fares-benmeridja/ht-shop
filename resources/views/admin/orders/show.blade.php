@extends('layouts.admin')

@section('title', 'Detailed Order')

@section('content')
    <h2>Detailed Order</h2>
    <div class="card mb-3  order">
        <div class="card-body">
            <h4 class="card-title">{{ "Client full name : ". $order->user->full_name }}</h4>
            <h5>Phone number: <span>{{ $order->user->phone }}</span></h5>
            <h5>Mailling Address: <p>{{ $order->address }}</p></h5>
            <h5>Show invoice : <a href="{{ route('invoice.download', $order) }}">Show</a></h5>
            <h5>Created date: <span>{{ $order->created_at->format('d-m-y') }}</span></h5>
        </div>
    </div>

    @foreach($order->products as $product)
    <div class="card mb-3  order">
        <img class="card-img-top" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) }}" alt="Card image cap">
        <div class="card-body">
            <h4 class="card-title">{{ $product->title }}</h4>
            <h5>Seller: <span>{{ $product->user->full_name }}</span></h5>
            <h5>Price: <span>{{ $product->formated_price }}</span></h5>
            <h5>Quantity: <span>{{ $product->pivot->quantity }}</span></h5>
        </div>
    </div>
    @endforeach

    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection