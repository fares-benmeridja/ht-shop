<?php

namespace Database\Seeders;

use App\helpers\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DairaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dairas = Helpers::arrayToStdClass(require_once __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dairas.php');

        foreach ($dairas as $daira)
        {
            DB::insert("INSERT INTO dairas (id, name, name_ar, wilaya_id) VALUES (:id, :name, :name_ar, :wilaya_id)",
                ['id' => $daira->id, 'name' => $daira->name, 'name_ar' => $daira->name_ar, 'wilaya_id' => $daira->wilaya_id]);
        }
    }
}
