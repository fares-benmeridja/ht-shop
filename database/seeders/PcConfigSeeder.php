<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PcConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            $arr = [
                'cpu_id' => Product::inRandomOrder()->where('category_id', 9)->pluck('id')->first(),
                "gpu_id" => Product::inRandomOrder()->where('category_id', 10)->pluck('id')->first(),
                "ram_id" => Product::inRandomOrder()->where('category_id', 11)->pluck('id')->first(),
                "mb_id"  => Product::inRandomOrder()->where('category_id', 12)->pluck('id')->first(),
                "psu_id" => Product::inRandomOrder()->where('category_id', 13)->pluck('id')->first(),
                "ssd_id" => Product::inRandomOrder()->where('category_id', 14)->pluck('id')->first(),
                "hdd_id" => Product::inRandomOrder()->where('category_id', 15)->pluck('id')->first(),
                "bt_id"  => Product::inRandomOrder()->where('category_id', 16)->pluck('id')->first(),
                "nc_id"  => Product::inRandomOrder()->where('category_id', 17)->pluck('id')->first(),
            ];

            foreach ($arr as $k => $el){
                foreach ($arr as $key => $item){
                    if ($k != $key){
                        DB::table("pc_configs")->insert([
                            ["compatible_with" => $el, "product_id" => $item],
                            ["product_id" => $el, "compatible_with" => $item],
                        ]);
                    }
                }
            }
        }
    }
}
