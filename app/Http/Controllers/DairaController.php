<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DairaController extends Controller
{
    public function getJson($id)
    {
        $dairas = DB::table('dairas')->where("wilaya_id" , $id)->get(['id', 'name']);
        return response()->json($dairas);
    }
}
