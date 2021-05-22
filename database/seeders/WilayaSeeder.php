<?php

namespace Database\Seeders;

use App\helpers\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilayas = Helpers::arrayToStdClass(require_once(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'wilayas.php'));

        foreach ($wilayas as $wilaya)
        {
            DB::insert("INSERT INTO wilayas (id, name, name_ar) VALUES (:id, :name, :name_ar)",
                ['id' => $wilaya->id, 'name' => $wilaya->name, 'name_ar' => $wilaya->name_ar]);
        }

    }
}
