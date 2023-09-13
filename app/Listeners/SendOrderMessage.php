<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderMessage
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
        $user = User::where('id',$order->user_id)->first();
        $user->notify(new OrderNotification($order));
        // Notification::send($user,new OrderNotification);
    }
    // public function handle(OrderCreated $event) {
    //     $order = $event->order;
    //     $user = User::where('store_id',$order->store_id)->first();
    //     $user->notify(new OrderCreatedNotification($order)); // notifyNow() // if one users
    //     NOtification::send($users,new OrderCreatedNotifiaction($order)); // mulitple users #sendNow()
}
