@extends('layouts.master')

@section('title', "RedArt - Home")

@section('content')

    <!--Start slider-->
    <div class="container">
        <main>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="information">
                        <h1>Build your own computer</h1>
                        <p>Your computer in just one click</p>
                        <div class="down"><a href="#DownToArticles">See more</a></div>
                        <ul class="list-group list-group-horizontal">
                            <li><a href="https://www.facebook.com/" target="_blanl">Facebook</a></li>
                            <li><a href="https://instagram.com/" target="_blank">Instagram</a></li>
                            <li><a href="mailto:ht-shop@mail.com=contact">Email</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 exposition">
                    <div id="carouselExampleControls" class="images carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('images/slider/macbook-pro-laravel.png') }}" style="margin-top: 200px; object-fit: contain" width="400px" height ="500px" alt="First slide">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--End slider-->

    <!--Start our articles-->
    <div class="our-articles" id="DownToArticles">
        <div class="container">
            <div class="articles-header">
                <h2>Our new articles</h2>
                <a href="{{ route('products.all') }}" target="_blank">All categories</a>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-5 col-lg-3">
                        <div class="card text-center">
                            <img class="card-img-top card-img-cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image ) }}" alt="{{ $product->title }}"/>
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
        </div>
    </div>
    <!--End Our articles-->

    <!--Start Choose us-->
    <div class="choose-us">
        <div class="container-fluid">
            <div class="row">
                <div class="image col-lg-6">
                    <img src="{{ asset('images/macbook/blog1.png') }}"  alt="choose-us">
                </div>
                <div class="info col-lg-6">
                    <h2>Why choose us</h2>
                    <h5>Quality and Quantity</h5>
                    <p>
                        Why not have both? All our products are high quality Artworks with a level of service only found through high-end galleries brought to your doorstep with a single call. That takes time, resources and talented craftsmanship.... We have plenty of those; You'll find teams of the finest Artists, Craftsmen and Craftswomen that not only are remarkable but most importantly... They care deeply about what they do.
                    </p>
                    <h5>Stars can't help but shine</h5>
                    <p>
                        It's as simple as that. with the click of a button, join our community of bright individuals come together to form constellations of stars, of all sizes and colours. So why waste your gaze on anything else but the best version of the shine you deserve.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--End Choose us-->


@endsection