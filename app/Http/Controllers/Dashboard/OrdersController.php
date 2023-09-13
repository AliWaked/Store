<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::paginate();
        return view('dashboard.orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        // dd(route('dashboard.orders.index'));
        $address = OrderAddress::where('order_id', $order->id)->first();
        $total = $order->OrderItems()->get()->sum(function ($item) {
            return $item->price;
        });
        return view('dashboard.orders.show', compact('order', 'address', 'total'));
    }
    public function update(Request $request, Order $order)
    {
        $order->update(['status' => 'delivered']);
        return route('dashboard.orders.index');
    }
}
