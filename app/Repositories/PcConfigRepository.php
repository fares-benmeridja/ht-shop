<?php

namespace App\Repositories;


use App\Models\PcConfig;
use App\Models\Product;

class PcConfigRepository extends ResourceRepository
{



    protected $model;

    public function __construct(PcConfig $config)
    {
        $this->model = $config;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all() :\Illuminate\Support\Collection
    {
        $products = Product::config()->withCategory()->published()->limit(200)->get(['id', 'title', 'slug', 'price', 'category_id']);

        $chunks = $products->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        $combine = collect([]);
        foreach ($products as $p){
            $combine->push($p->category->name);
        }

        return $combine->unique()->combine($chunks);
    }

    public function getCompatibles($id) :\Illuminate\Support\Collection
    {
        $product = Product::findOrFail($id, ['id', 'title', 'slug', 'price', 'category_id'])->compatibles;
        $product->load('category');

        $chunks = $product->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        $combine = collect([]);
        foreach ($product as $p){
            $combine->push($p->category->name);
        }

        return $combine->combine($chunks);
    }


}