<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class MainController extends Controller
{
    private const LIMIT = 3;

    public function __invoke()
    {
        $categories = Category::all();
        $products = Product::with('images')
            ->withCategory()->published()
            ->orderBy('created_at', 'DESC')
            ->limit(self::LIMIT)->get();

        return view('client.main', compact('categories', 'products'));
    }
}
