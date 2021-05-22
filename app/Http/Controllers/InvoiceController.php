<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{


    public function download(Order $order)
    {
        if (! Gate::allows('view-invoice', $order)) {
            abort(404);
        }

        $order->load(['user', 'commune']);
        $order->loadProducts();

        return view('client.invoice.show', compact('order'));
    }
}
