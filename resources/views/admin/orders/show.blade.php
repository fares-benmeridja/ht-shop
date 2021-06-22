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

{{--    @foreach($order->products as $product)--}}
{{--    <div class="card mb-3  order">--}}
{{--        <img class="card-img-top" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) }}" alt="Card image cap">--}}
{{--        <div class="card-body">--}}
{{--            <h4 class="card-title">{{ $product->title }}</h4>--}}
{{--            <h5>Seller: <span>{{ $product->user->full_name }}</span></h5>--}}
{{--            <h5>Price: <span>{{ $product->formated_price }}</span></h5>--}}
{{--            <h5>Quantity: <span>{{ $product->pivot->quantity }}</span></h5>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @endforeach--}}


    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators" style="bottom: -23px">
            @for($i=0; $i < $count; $i++)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{ $i }}" @if($i === 0) class="active" @endif></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @foreach($order->products as $product)
            <div class="carousel-item @if($loop->first) active @endif">
                <div class="card text-center">
                    <img style="width: 100px; height: 100px; margin: auto" class="mt-4  card-img-top card-img-cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) }}" alt=""/>
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->title }}</h4>
                        <h6 class="card-subtitle text-muted">Seller: <span>{{ $product->user->full_name }}</span></h6>
                        <span>{{ $product->formated_price }}</span>
                        <p>Quantity: <span>{{ $product->pivot->quantity }}</span></p>
                        <br>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span style="color: blue" class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span style="color: blue" class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row">
        @include('admin.includes.footer')
    </div>
@endsection