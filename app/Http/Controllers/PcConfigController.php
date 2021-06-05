<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\PcConfigRepository;
use Illuminate\Http\Request;

class PcConfigController extends Controller
{


    public function __construct(
        private PcConfigRepository $configRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->configRepository->all();
        return view('client.pc-config.index', compact('products'));
    }

    public function getJson($id)
    {
        $products = $this->configRepository->getCompatibles($id);
        dd(response()->json($products));
        return response()->json($products);
    }
}
