<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use Illuminate\Support\Collection;

class Checkout
{
    /**
     * Create Order
     *
     * @param array $data
     * @param Collection $cartItems
     * @return array
     */
    public function handle(array $data, Collection $cartItems): array
    {
        $order = Order::create();
        $total_price = 0;
        $data['order_id'] = $order->id;
        $address = OrderAddress::create($data);
        foreach ($cartItems as $item) {
            $product = $item->product;
            $items[] = [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $product->product_name,
                'price' => $product->price,
                'quantity' => $item->quantity,
                'color' => $item->color->color_name,
                'size' => $item->size,
            ];
            $total_price += $product->price;
        }
        OrderItem::insert($items);
        return [$order, $total_price];
    }
}
