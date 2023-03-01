<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
//            WilayaSeeder::class,
//            DairaSeeder::class,
//            CommuneSeeder::class,
//            RoleSeeder::class,
//            CategorySeeder::class,
//            PcConfigCategorySeeder::class,

            PcConfigSeeder::class
        ]);

//        \App\Models\User::factory(10)->create();
//        \App\Models\Product::factory(500)->create();
//
//        for ($i=0; $i < 2000; $i++)
//            \App\Models\Image::factory()->create();
    }
}
