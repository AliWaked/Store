<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use JsonException;

class CartController extends Controller
{
    public function __construct(public CartRepository $cart)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodcuts = $this->cart->get();
        $total = $this->cart->total() ?? 0;
        return view('front.cart.index', ['products' => $prodcuts, 'total' => $total]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'color_name' => 'required|string',
            'size_name' => 'required|string',
            'quantity' => 'nullable|numeric|gt:0',
        ], [
            'required' => 'this filed is required',
            'quantity.numeric' =>  'the quantity must be number',
        ]);
        $options =  ['size' => $request->size_name, 'color' => $request->color_name];
        if (!$this->cart->get()->where('product_id', $product->id)->where('options', $options)->first()) {
            $this->cart->add($product->id, $options, $request->quantity ?? 1);
        } else {
            $this->cart->update($product->id, $options, $request->quantity ?? 1);
        }
        return to_route('front.cart.shopping');
    }

    /** 
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        // return $request->;
        $this->cart->delete($product->id, ['size' => $request->size, 'color' => $request->color]);
        return $this->cart->total();
    }
}
