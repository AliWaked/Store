<?php

namespace App\Enums;

enum OrderStatus: string
{
    use \App\Concerns\HasManyValues;
    case NOTDELIVERED =  'not delivered';
    case DELIVERED = 'delivered';
    case PENDING = 'pending';
}
