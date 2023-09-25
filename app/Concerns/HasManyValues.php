<?php

namespace App\Concerns;

trait HasManyValues
{
    public static function getValues(): array
    {
        foreach (static::cases() as $item) {
            $values[] = $item->value;
        }
        return $values;
    }
}
