@extends('layouts.master')

@section('title', "RedArt - Home")

@section('content')

    <!--Start slider-->
    <div class="container">
        <main>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="information">
                        <h1> We Shine For You</h1>
                        <p>No need to chase the Moon ... We can bring you all the Stars</p>
                        <div class="down"><a href="#DownToArticles">See more</a></div>
                        <ul class="list-group list-group-horizontal">
                            <li><a href="https://www.facebook.com/RedArt.dz" target="_blanl">Facebook</a></li>
                            <li><a href="https://instagram.com/redart_dz?igshid=dcjv9wcvvjcm" target="_blank">Instagram</a></li>
                            <li><a href="mailto:redart_dz@hotmail.com=contact">Email</a></li>
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
                <h2>Our articles</h2>
                <a href="{{ route('products.all') }}" target="_blank">All categories</a>
            </div>
            <div class="row">
                <div class="brand col-lg-3 col-md-2">
                    <img src="{{ asset('img/logo.png') }}" width="300px" height="100px" alt="">
                </div>
                @foreach($products as $product)
                <div class="col-md-3 col-lg-3">
                    <div class="card text-center">
                        <img class="card-img-top card-img-cover" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$product->first_image) }}"  alt=""/>
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->limited_title }}</h4>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6>
                            <span>{{ $product->formated_price }}</span>
                            <br>
                            <a href="{{ route('products.shop', ['slug' => $product->category->slug, 'product' => $product]) }}" target="_blank">More</a>
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

    <!--Start categories-->
    <div class="categories">
        <div class="container my-4">
            <h2>Categories</h2>
            <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
                <a class="carousel-control-prev" href="#multi-item-example" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#multi-item-example" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <ol class="carousel-indicators">
                    <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
                    <li data-target="#multi-item-example" data-slide-to="1"></li>
                    <li data-target="#multi-item-example" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                @foreach($categories->chunk(3) as $chunk)
                    <div class="carousel-item @if($loop->first) active @endif">
                        <div class="row">
                            @foreach($chunk as $category)
                            <div class="col-md-4 @if(! $loop->first) clearfix d-none d-md-block @endif ">
                                <div class="card mb-2">
                                    <img class="card-img-top" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$category->image) }}"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title text-center"><a href="{{ route('products.category', $category->slug) }}">{{ $category->name }}</a></h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--End categories-->

    <!--Start Call to action -->
    <div class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="left col-md-8 text-center text-md-left">
                    <p>We Shine For You</p>
                </div>
                @guest
                <div class="right col-md-4 text-center text-md-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signup">Sign up now</button>
                </div>
                @endguest
            </div>
        </div>
    </div>
    <!--End Call to action-->

    <!--Start follow us-->
    <div class="follow-us text-center">
        <div class="blank"></div>
        <div class="social">
            <p>Follow us on</p>
            <a href="https://www.facebook.com/RedArt.dz" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="https://instagram.com/redart_dz?igshid=dcjv9wcvvjcm" target="_blank"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
    <!--End follow us-->
@endsection