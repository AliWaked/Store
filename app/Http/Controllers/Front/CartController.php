<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Repository\CartRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use JsonException;

class CartController extends Controller
{
    public function __construct(public CartRepository $cart)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // dd($this->cart->get()->first());

        return view('front.cart.index', [
            'products' => $this->cart->get(),
            'total' => $this->cart->total(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $this->cart->addOrUpdate($product->id, $data['color_id'], $data['quantity']);
        return to_route('front.cart.shopping');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRequest $request, Product $product): float
    {
        $data = $request->validated();
        $this->cart->delete($product->id, $data['color_id'], $data['size']);
        return $this->cart->total();
    }
}
