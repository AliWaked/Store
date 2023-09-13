<?php

namespace App\Repository;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartModelRepository implements CartRepository
{
    public $items = [];
    public function __construct()
    {
        $this->items = collect([]);
    }
    public function get(): Collection
    {
        if (!$this->items->count()) {
            $this->items = Cart::with('product')->get();
        }
        return $this->items;
    }
    public function add($id, $options, $quantity): void
    {
        $item = Cart::create([
            'product_id' => $id,
            'cookie_id' => Cart::getCookieId(),
            'quantity' => $quantity,
            'options' => $options
        ]);
        $this->items->push($item);
    }
    public function update($id, $options, $quantity): void
    {
        // dd(Cart::all()->where('product_id', $id)->where('option);
        Cart::all()->where('product_id', $id)->where('options', $options)->first()->update(['quantity' => $quantity]);
    }
    public function delete($id, $options): void
    {
        Cart::all()->where('product_id', $id)->where('options', $options)->first()->delete();
    }
    public function empty(): void
    {
        Cart::query()->delete();
    }
    public function total(): float
    {
        return $this->get()->sum(function ($item) {
            return $item->product->price;
        });
    }
}
