<?php

namespace App\Services\Front;

use App\Models\Color;
use App\Models\Department;
use App\Models\Product;
use Illuminate\Support\Arr;

class ColorService
{
    /**
     * Get Avilable Size For Product
     *
     * @param Product $product
     * @param Color $color
     * @return array
     */
    public function getSizeForProduct(Product $product, Color $color): array
    {
        $data = $product->colors()->where('colors.id', $color->id)->pluck('size')->toArray();
        // if ($data) {
        //     return $data->pluck('size')->toArray();
        // }
        return $data;
    }

    /**
     * Get Color And Size 
     *
     * @param Department $department
     * @param array $data
     * @return array
     */
    public function getColorSize(Department $department, array $data): array
    {
        $products = $department->categories()->where('id', $data['category'])->first()->products()->with('colors')->get();
        if (!Arr::exists($data, 'size')) {
            $result = [];
            foreach ($products as $product) {
                // $result = [...$result, ...$product->colors()->pluck('size')->toArray()];
                $result = Arr::collapse([$result, $product->colors()->pluck('size')->toArray()]);
            }
            return array_values(array_unique($result));
        }
        $colorName = [];
        foreach ($products as $product) {
            $colorName = [...$colorName, ...$product->colors()->where('size', $data['size'])->pluck('color_name')->toArray()];
        }
        return array_values($colorName);
    }
}
