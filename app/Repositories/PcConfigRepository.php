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
        $combine = collect(['CPUs', 'GPUs', 'RAMs', 'MBs', 'PSUs', 'SSDs', 'HDDs', 'Boitiers', 'NetCs']);

        $products = Product::config()->withCategory()->published()->limit(200)->get();

        $chunks = $products->chunkWhile(function ($value, $key, $chunk){
            return $value->category->name === $chunk->last()->category->name;
        });

        return $combine->combine($chunks);
    }



}