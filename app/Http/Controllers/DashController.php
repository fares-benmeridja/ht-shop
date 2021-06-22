<?php

namespace App\Http\Controllers;

class DashController extends Controller
{
    public function __invoke()
    {
        return view('admin.home');
    }
}
