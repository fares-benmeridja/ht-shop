<?php

namespace App\Http\Controllers;

use App\helpers\Helpers;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.orders.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $duplicata = Cart::search(function ($cartItem) use($product){
            return $cartItem->id === $product->id;
        })->isNotEmpty();

        if ($duplicata){
            session()->flash('error', 'Article already in the shopping cart.');

            return request()->ajax()
                ? response()->json(['route' => back()])
                : redirect()->back();
        }

        $product->load(['images', 'category']);
        Cart::add($product->id, $product->title, 1, $product->price,
            [
                'image'     => $product->first_image,
                'category'  => $product->category->name,
                'cat_slug'  => $product->category->slug,
                'product_slug' => $product->slug,
                'title'     => $product->title,
                "qty_dispo" => $product->quantity,
                "product_id" => $product->id
            ]);

        session()->flash('success', 'Article added in shopping cart successfuly.');

        return request()->ajax()
            ? response()->json(['route' => route('products.shop', ['slug' => $product->category->slug, 'product' => $product])])
            : redirect()->route('products.shop', ['slug' => $product->category->slug, 'product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $rowId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $request->validate([
            'counter' => 'required|in:DESC,ASC',
        ]);
        $counter = $request->counter;

        $cart = Cart::get($rowId);

        if ($counter == 'ASC'){
            if ($cart->qty === $cart->options->qty_dispo){
                return response()->json(['error' => true]);
            }
            Cart::update($rowId, $cart->qty + 1);
        }else{
            if ($cart->qty === 1){
                return response()->json(['error' => true]);
            }
            Cart::update($rowId, $cart->qty - 1);
        }

            $cart = Cart::get($rowId);
        return response()->json([
            'max' => $cart->options->qty_dispo,
            'message' => "Cart quantity updated.",
            'qty'     => $cart->qty,
            'count'   => Cart::count(),
            'total'   => Helpers::getDinarPrice(Cart::total()),
            'price'   => Helpers::getDinarPrice($cart->subtotal())
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $rowId
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return back()->withSuccess('Article removed from cart succesfuly.');
    }
}
