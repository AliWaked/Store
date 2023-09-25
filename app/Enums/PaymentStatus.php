<?php

namespace App\Enums;

enum PaymentStatus: string
{
    use \App\Concerns\HasManyValues;
    case PENDING =  'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
}
