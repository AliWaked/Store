<?php

namespace App\Http\Controllers\Front;

use App\Actions\Checkout;
use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repository\CartRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function __construct(protected CartRepository $cart)
    {
        //
    }
    public function index(): View|null
    {
        if (!$this->cart->get()->count()) {
            return null;
        }
        return view('front.checkout.index');
    }
    public function store(CheckoutRequest $request, Checkout $checkout): JsonResponse
    {
        DB::beginTransaction();
        try {
            [$order, $total_price] = $checkout->handle($request->validated(), $this->cart->get());
            DB::commit();
            event(new OrderEvent($order));
            // $this->cart->empty();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return Response::json([
            'message' => 'success',
            'order' => $order,
            'total_price' => $total_price,
        ]);
    }
}
