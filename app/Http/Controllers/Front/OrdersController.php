<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        return view('front.orders.index', [
            'orders' => Order::where('user_id', Auth::id())->get(),
        ]);
    }
    public function show(Order $order)
    {
        $address = $order->address()->first();
        $total = $order->OrderItems()->get()->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        return view('front.orders.show', ['order' => $order, 'address' => $address, 'total' => $total]);
    }
}
