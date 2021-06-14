<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class UpdateConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::whereBetween('category_id', [9, 17])->with('category')->get();

        foreach ($products as $product){
            switch ($product->category->name){
                case 'Processor':
//                    $product->update(['title' => ]);
                    break;
            }
        }
    }
}
