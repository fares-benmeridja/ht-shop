<?php

namespace App\Http\Controllers;


use App\Models\Product;

class MainController extends Controller
{
    private const LIMIT = 12;

    public function __invoke()
    {
        $products = Product::with('images')
            ->withCategory()->published()
            ->orderBy('created_at', 'DESC')
            ->limit(self::LIMIT)->get();

        return view('client.main', compact('products'));
    }
}
