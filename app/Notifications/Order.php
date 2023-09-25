<?php

namespace App\Notifications;

use App\Models\Order as ModelsOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Order extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public ModelsOrder $order)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('welcome ' . $notifiable->name)
            ->line('Order Drived')
            ->line("order number: {$this->order->number}")
            ->line("order number of items: {$this->order->items_count}")
            ->line("order total price: {$this->order->total_price}")
            ->action('Visit Site', url('/'))
            ->line('Thank you for using our Store');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
