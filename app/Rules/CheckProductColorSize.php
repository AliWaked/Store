<?php

namespace App\Rules;

use App\Enums\Colors;
use App\Enums\Size;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckProductColorSize implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $size => $colors) {
            if (!in_array($size, Size::getValues())) {
                $fail("this size ($size) not found");
            }
            foreach ($colors as $color) {
                if (in_array($color, Colors::getValues())) {
                    continue;
                }
                $fail('this size is not found');
            }
        }
    }
}
