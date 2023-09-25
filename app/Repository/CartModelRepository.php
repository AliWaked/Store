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
            $this->items = Cart::with(['product', 'color'])->get();
        }
        return $this->items;
    }

    public function addOrUpdate(int $id, int $color_id, int $quantity): void
    {
        $cart = Cart::updateOrCreate([
            'product_id' => $id,
            'color_id' => $color_id,
        ], [
            'quantity' => $quantity,
            'cookie_id' => Cart::getCookieId(),
        ]);
        $this->items->push($cart);
    }
    public function delete(int $id, int $color_id, string $size): void
    {
        Cart::where([
            'product_id' => $id,
            'color_id' => $color_id,
            'size' => $size,
        ])->delete();
    }
    public function empty(): void
    {
        Cart::query()->delete();
    }
    public function total(): float
    {
        return $this->get()->sum(function ($item) {
            return $item->product->price;
        }) ?? 0;
    }
}
