<?php

namespace App\Services\Front;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavouriteService
{
    /**
     * Add Product To Favourite
     *
     * @param Product $product
     * @return void
     */

    public function store(Product $product): void
    {
        $user = Auth::user();
        $pro = ($data = $user->products()->where('product_id', $product->id))->first();
        if (!$pro) {
            $user->products()->attach(
                [
                    'product_id' => $product->id,
                ],
                [
                    'is_favourite' => true,
                ]
            );
        } else if ($pro->pivot?->is_favourite == null || !$pro->pivot->is_favourite) {
            $data->syncWithoutDetaching([
                $product->id => [
                    'is_favourite' => true
                ]
            ]);
        }
    }
    /**
     * Remove Product From Favourtie
     *
     * @param Product $product
     * @return boolean
     */

    public function destroy(Product $product): bool
    {
        $product = ($products = Auth::user()->products())->where('product_id', $product->id)->first();
        if ($product) {
            $products->syncWithoutDetaching([
                $product->id => [
                    'is_favourite' => false
                ]
            ]);
            return true;
        }
        return false;
    }
}
