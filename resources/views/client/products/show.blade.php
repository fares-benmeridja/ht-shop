@extends('layouts.master')

@section('title', 'RedArt - Detailed article')

@section('content')
    <!--Start Detailed article-->
    <div class="container">
        <div class="detailed-article">
            <h2>Article description</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @for($i = 0; $i < $image_count; $i++)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="@if($i === 0) active @endif"></li>
                            @endfor
                        </ol>
                        <div class="carousel-inner">
                        @foreach($product->images as $image)
                            <div class="carousel-item @if($loop->first) active @endif">
                                <img class="d-block w-100" src="{{ asset('storage'.DIRECTORY_SEPARATOR.$image->code) }}" alt="">
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3>{{ $product->title }}</h3>
                    <span>{{ $product->formated_price }}</span>
                    <P>{{ $product->description }}</P>

                    <form action="{{ route('cart.store', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Detailed Article-->
@endsection