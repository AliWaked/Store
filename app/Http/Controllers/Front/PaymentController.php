<?php

namespace App\Http\Controllers\Front;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{
    public function payment(Request $request, Order $order)
    {
        // return Response::json([
        //     'message' => 'success',
        // ]);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', $order->id),
                "cancel_url" => route('cancel.payment', $order->id),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $order->orderItems->sum(function ($item) {
                            return $item->price;
                        }) + 5 ?? 5,
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment', ['order' => $order->id])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    public function store(Request $request, Order $order)
    {
        $order->status = OrderStatus::NOTDELIVERED->value;
        $order->payment_status = PaymentStatus::PENDING->value;
        $order->save();
        return to_route('checkout')->with('success','success pay');
        // dd($request,$order->status);
    }

    public function cancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error',  'You have canceled the transaction.');
    }

    public function success(Request $request, $order)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('create.payment', ['order' => $order])
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('create.payment', ['order' => $order])
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
