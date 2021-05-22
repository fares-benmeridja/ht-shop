@extends('layouts.admin')

@section('title', 'Detailed Article')

@section('content')
<!-- MAIN CONTENT-->
<div class="container">
    <div class="detailed-article">
        <h2>Detailed Article</h2>
        <div class="row">
            <div class="col-lg-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0; $i < $count; $i++)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($i === 0) class="active" @endif></li>
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
                <h4 >Article name :<span class="ml-2">{{ $product->title }}</span></h4>
                @if(Auth::user()->is_main_admin || Auth::user()->is_editor)
                <h4 >Seller full name :<span class="ml-2">{{ $product->user->full_name }}</span></h4>
                @endif
                <h4 >Price :<span class="ml-2">{{ $product->formated_price }}</span></h4>
                <h4 >Description :</h4>
                <P>{{ $product->description }}</P>
                <h5 >Creation date :<span class="ml-2">{{ $product->created_at->format('d-m-Y') }}</span></h5>
                <h5 >Edit date :<span class="ml-2">{{ $product->updated_at->format('d-m-Y') }}</span></h5>
                @can('published')
                <form id="online-form" class="form-check" method="POST" action="{{ route('products.online', $product) }}">
                    @csrf
                    @method('PUT')
                    <input class="form-check-input" {{ $product->online ? 'checked' : null }} type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Published
                    </label>
                </form>
                @endcan
                @can('update', $product)
                <a href="{{ route('products.edit', $product) }}" style="color: #e2c705 !important; background-color: #140c4c !important; margin-top: 36px;" type="button" class="btn btn-primary"><i class="fa fa-edit mr-1"></i>Edit</a>
                @endcan
                @can('delete', $product)
                <button type="button" onclick="event.preventDefault(); document.getElementById('delete-product').submit();" class="btn btn-primary"><i class="fa fa-trash mr-1"></i>Delete</button>


                <form id="delete-product" action="{{ route('products.destroy', $product) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
                @endcan
            </div>
        </div>
    </div>
<!-- END MAIN CONTENT-->
    <div class="row">
        @include('admin.includes.footer')
    </div>

@endsection