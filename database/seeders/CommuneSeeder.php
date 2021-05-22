<?php

namespace Database\Seeders;

use App\helpers\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $communes = Helpers::arrayToStdClass(require_once __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'communes.php');

        foreach ($communes as $commune)
        {
            DB::insert("INSERT INTO communes (id, name, name_ar, daira_id) VALUES (:id, :name, :name_ar, :daira_id)",
                ['id' => $commune->id, 'name' => $commune->name, 'name_ar' => $commune->name_ar, 'daira_id' => $commune->daira_id]);
        }
    }
}
