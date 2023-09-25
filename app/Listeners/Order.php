<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class Order
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $order = $event->order;
        $user = User::where('id', $order->user_id)->first();
        $user->notify(new \App\Notifications\Order($order));
        // Notification::send($event->user, new \App\Notifications\Order($event->order));
    }
}
