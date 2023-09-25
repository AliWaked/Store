<?php

namespace App\Services\Dashboard;

use App\Enums\OrderStatus;
use App\Models\Order;

class OrderService
{
    /**
     * Update Order Status
     *
     * @param Order $order
     * @return boolean
     */
    public function update(Order $order): bool
    {
        return $order->update(['status' => OrderStatus::DELIVERED->value]);
    }
}
