<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function __invoke()
    {
        return view('admin.home');
    }
}
