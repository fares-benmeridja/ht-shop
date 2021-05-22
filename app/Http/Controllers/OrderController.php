<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private const PERPAGE = 15;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['user', 'commune'])->orderBy('created_at', 'DESC')->simplePaginate(self::PERPAGE);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(OrderStoreRequest $request)
    {
        $order = $this->orderRepository->store($request->all());

        return $request->ajax()
            ? response()->json(['route' => route('thankyou', $order)])
            : redirect()->route('thankyou', $order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load(['user', 'commune']);
        $order->loadProducts();

        return view('admin.orders.show', compact('order'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $this->orderRepository->destroy($order);

        session()->flash('success', 'Order deleted successfuly.');
        return redirect()->route('orders.index');
    }
}
