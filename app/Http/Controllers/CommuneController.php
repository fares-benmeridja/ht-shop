<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class CommuneController extends Controller
{
    public function getJson($id)
    {
        $communes = DB::table('communes')->where("daira_id" , $id)->get(['id', 'name']);
        return response()->json($communes);
    }
}
