<?php

namespace Database\Seeders;

use App\helpers\Helpers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Helpers::arrayToStdClass(require_once __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'roles.php');

        foreach ($roles as $role)
        {
            DB::insert("INSERT INTO roles (name) VALUES (:name)",
                ['name' => $role->name]);
        }
    }
}
