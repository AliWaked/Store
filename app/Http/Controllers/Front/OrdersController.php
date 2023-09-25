<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index(): View
    {
        return view('front.orders.index', [
            'orders' => Order::withCount('orderItems')->withSum('orderItems as total_price', 'price')->where('user_id', Auth::id())->get(),
        ]);
    }
    public function show(Order $order): View
    {
        $order->load('address')->loadCount('orderItems')->loadSum('orderItems as total_price', 'price');
        return view('front.orders.show', [
            'order' => $order
        ]);
    }
}
