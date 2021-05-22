<?php

namespace App\Http\Middleware;

use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::count() < 1){
            return redirect()->route('products.all')->withError('Shopping cart is empty.');
        }
        return $next($request);
    }
}
