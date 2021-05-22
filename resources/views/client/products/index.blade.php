@extends('layouts.master')

@section('title', 'RedArt - '. $title)

@section('content')
    <!--Start our articles-->
    <div class="our-articles" id="DownToArticles">
        <div class="container">
            <div class="articles-header">
                <h2>{{ $title }}</h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-5 col-lg-3">
                    <div class="card text-center">
                        <img class="card-img-top card-img-cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image ) }}" alt=""/>
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->limited_title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $category->name ?? $product->category->name }}</h6>
                            <span>{{ $product->formated_price }}</span>
                            <br>
                            <a href="{{ route('products.shop', ['slug' => $category->slug ?? $product->category->name, 'product' =>$product]) }}" target="_blank">More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
    <!--End Our articles-->
@endsection