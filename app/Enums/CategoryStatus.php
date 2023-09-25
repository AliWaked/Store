<?php

namespace App\Enums;

enum CategoryStatus: string
{
    use \App\Concerns\HasManyValues;
    case ACTIVE =  'active';
    case ARCHIVE = 'archive';
}
