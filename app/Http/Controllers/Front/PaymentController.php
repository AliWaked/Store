<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        $provider = new ExpressCheckout;
        // $provider = new AdaptivePayments;

        // $provider = PayPal::setProvider('express_checkout');
        // $provider = PayPal::setProvider('adaptive_payments');  

        $orderId = Order::where('user_id', Auth::id())->where('status', 'not delivered')->where('payment_stauts', 'pending')->last()->id;
        $orderItem = OrderItem::where('order_id', $orderId)->get();

        $data = [];
        foreach ($orderItem as $item) {
            $data['items'][] = [
                'name' => $item->product_name,
                'price' => $item->price,
                'desc'  => 'the color is '. $item->color . ' and the size is ' . $item->size,
                'qty' => $item->quantity
            ];
        }
        $data['invoice_id'] = $orderId;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/payment/success');
        $data['cancel_url'] = url('/cart');

        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $data['total'] = $total;

        // //give a discount of 10% of the order amount
        // $data['shipping_discount'] = round((10 / 100) * $total, 2);


        $response = $provider->setExpressCheckout($data);

        // Use the following line when creating recurring payment profiles (subscriptions)
        $response = $provider->setExpressCheckout($data, true);

        // This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }
}
