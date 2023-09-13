<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function __construct(public CartRepository $cart)
    {
    }
    public function index()
    {
        // $address = OrderAddress::create([
        //     'order_id' => 13,
        //     'street' => 'required',
        //     'city' => 'required',
        //     'countiry' => 'required',
        //     'phone_number' => 1010,
        //     'postal_code' => 'ps',
        // ]);
        // dd($address);
        // dd($year = Carbon::now()->year, Product::whereYear('created_at', $year)->first()->id,Order::whereYear('created_at',$year)->max('number'));
        if (!$this->cart->get()->count()) {
            return;
        }
        return view('front.checkout.index');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $clearn = $request->validate([
                'street' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'countiry' => 'required|max:255',
                'phone_number' => 'required|max:13',
                'postal_code' => 'required|string|max:2',
            ]);
            $order = Order::create([
                'user_id' => Auth::id(),
            ]);
            $data = $request->merge([
                'order_id' => $order->id,
            ]);
            $address = OrderAddress::create($data->all());
            foreach ($this->cart->get() as $item) {
                $product = $item->product;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'color' => $item->options['color'],
                    'size' => $item->options['size'],
                ]);
            }
            DB::commit();
            event(new OrderEvent($order));
            // return $item->quantity;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
            // return to_route('checkout')->withErrors($validator);
            // return Redirect::withErrors($validator);
        }
        // $products = $this->cart->get()
        return 'success';
    }
}
