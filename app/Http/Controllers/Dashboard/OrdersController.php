<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Services\Dashboard\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
        //
    }
    public function index(): View
    {
        return view('dashboard.orders.index', [
            'orders' => Order::with('user')->withSum('orderItems as total_price', 'price')->paginate(),
        ]);
    }
    public function show(Order $order): View
    {
        $order->load(['address', 'user'])->loadCount('orderItems')->loadSum('orderItems as total_price', 'price');
        return view('dashboard.orders.show', compact('order'));
    }
    public function update(Order $order): JsonResponse
    {
        $bool = $this->orderService->update($order);

        return Response::json([
            'url' => route('dashboard.orders.index'),
        ]);
    }
}
