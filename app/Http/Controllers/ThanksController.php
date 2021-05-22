<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class ThanksController extends Controller
{
    public function __invoke(Order $order)
    {
        if (! Gate::allows('view-invoice', $order)) {
            abort(404);
        }
        return view("thankyou", compact('order'));
    }
}
