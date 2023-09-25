<?php

namespace App\Enums;

use App\Concerns\HasManyValues;

enum Size: string
{
    use HasManyValues;
    case XL = 'xl';
    case L = 'l';
    case M = 'm';
    case S = 's';
}
