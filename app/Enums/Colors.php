<?php

namespace App\Enums;

use App\Concerns\HasManyValues;

enum Colors: string
{
    use HasManyValues;
    case RED = 'red';
    case BLUE = 'blue';
    case GREEN = 'green';
    case YELLOW = 'yellow';
    case BLACK = 'black';
    case WHITE = 'white';
    case ORANGE = 'orange';
    case GRAY = 'gray';
}
