@extends('layouts.master')

@section('title', 'ht_shop - Shopping Cart')

@section('content')
    <!--Start panier-->
    <div class="shopping-cart px-4 px-lg-0">
        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 rounded shadow-sm mb-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0">
                                        <div class="py-2 text-uppercase">Unit price</div>
                                    </th>
                                    <th scope="col" class="border-0">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0">
                                        <div class="py-2 text-uppercase">Subtotal</div>
                                    </th>
                                    <th scope="col" class="border-0">
                                        <div class="py-2 text-uppercase">Remove</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $cart)
                                <tr class="js-cart-tr">
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="{{ asset('storage'.DIRECTORY_SEPARATOR.$cart->options->image) }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"><a href="{{ route('products.shop', ['slug' => $cart->options->cat_slug, 'product' => $cart->options->product_slug]) }}" class="text-dark d-inline-block align-middle">{{ $cart->options->title }}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Category: {{ $cart->options->category }}</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>{{ \App\helpers\Helpers::getDinarPrice($cart->price) }}</strong></td>
                                    <td class="border-0 align-middle">
                                        <strong>
                                            <div class="qty mt-5" data-action="{{ route('cart.update', $cart->rowId) }}">

                                                <span role="button" class="minus bg-dark @if($cart->qty === 1) d-none @endif js-counter" data-target  data-counter="DESC">-</span>

                                                <input type="number" class="count js-cart-qty" disabled name="qty" value="{{ $cart->qty}}">

                                                <span role="button" class="plus bg-dark @if($cart->qty === $cart->options->qty_dispo) d-none @endif js-counter" data-counter="ASC">+</span>
                                            </div>
                                        </strong>
                                    </td>
                                    <td class="border-0 align-middle"><strong class="js-cart-product-subTotal">{{ \App\helpers\Helpers::getDinarPrice($cart->subtotal()) }}</strong></td>
                                    <td class="border-0 align-middle">
                                    <form method="POST" action="{{ route('cart.destroy', $cart->rowId) }}">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" style="border: none; background: transparent;" class="text-dark"><i style="font-size: 18px;" class="fa fa-trash"></i></button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row py-5 p-4  rounded shadow-sm">
{{--                    <div class="description col-lg-6">--}}
{{--                        <div class="heading rounded-pill px-4 py-3 text-uppercase font-weight-bold">Description of the product</div>--}}
{{--                        <div class="p-4">--}}
{{--                            <p class="font-italic mb-4">Please describe the product that you want to buy (Dimensions, colors ...)</p>--}}
{{--                            <textarea name="description" id="checkout-desc" cols="30" rows="2" class="form-control"></textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="order-summary col-lg">
                        <div class="heading rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                        <div class="p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold js-cart-total">{{ \App\helpers\Helpers::getDinarPrice(Cart::total()) }}</h5>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-dark rounded-pill py-2 btn-block" data-toggle="modal" data-target="#checkout">Procceed to checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Start Modal-->
    <div class="window">
        <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="checkout-modal" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkout-modal">Fill the fields below to confirm your order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="checkout-form" action="{{ route('orders.store') }}" class="form-sign-up" method="POST">
                            @csrf

                            <div class="form-row js-loader">
                                <div class="form-group col-md-12">
                                    <label class="required" for="address">Mailing address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Cité 124 logements">
                                </div>
                            </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Modal-->

    <!--End panier-->
@endsection