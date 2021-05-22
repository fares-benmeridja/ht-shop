<?php

namespace Database\Seeders;

use App\helpers\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Helpers::arrayToStdClass(require_once __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'categories.php');

        foreach ($categories as $category)
        {
            DB::insert("INSERT INTO categories (name, image, slug) VALUES (:name, :image, :slug)",
                ['name' => $category->name, 'image' => $category->image, 'slug' => $category->slug]);
        }
    }
}
