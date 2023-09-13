<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;
    protected $table = 'order_address';
    protected $fillable = [
        'order_id', 'countiry', 'city', 'street', 'phone_number', 'postal_code',
    ];
    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
