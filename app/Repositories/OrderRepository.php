<?php

namespace App\Repositories;


use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepository extends ResourceRepository
{


    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function store(array $inputs)
    {
        try {
            DB::beginTransaction();

            $inputs['user_id'] = Auth::user()->id;
            $order = parent::store($inputs);

            $order->products()->sync($this->syncDataTable());

            DB::commit();
            Cart::destroy();
            return $order;
        }catch (\Exception $e){
            DB::rollBack();
            abort(500);
        }
    }



    public function syncDataTable()
    {
        $data = [];

        foreach (Cart::content() as $cart)
        {
            $product = Product::findOrFail($cart->options->product_id);
            $product->update(['qty_available' => $product->qty_available - $cart->qty]);
            $data[$cart->options->product_id] = [ 'quantity' => $cart->qty, "return_code" => Str::uuid()->toString()];
        }

        return $data;
    }
}