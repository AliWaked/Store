<?php

namespace App\Services\Front;

use App\Models\Department;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class ProductService
{
    /**
     * Get Product
     *
     * @param Department $department
     * @param array $data
     * @return array
     */
    public function getProducts(Department $department, array $data): array
    {
        $categories = $department->categories()->has('products')->get();
        $products = $department->products()->search($data)->get();

        $values = [
            'category' => $data['category_name'] ?? '',
            'size' => $data['size_name'] ?? '',
            'color' => $data['color_name'] ?? '',
        ];
        return [
            'department' => $department,
            'categories' => $categories,
            'products' => $products,
            'values' => $values,
        ];
    }

    /**
     * Get Data (Colors and Sizes) Avilable For Product
     *
     * @param Product $product
     * @return array
     */
    public function getDataForShowProduct(Product $product): array
    {
        // $data = $product->colors()->pluck('size', 'color_name')->toArray();
        // $colors = array_keys($data);
        // $sizes = array_values($data);
        // loadCount(['users' => function (Builder $builder) {
        //     $builder->whereNotNull('comment');
        // }])
        return [
            'product' => $product->load(['users' => function ($builder) {
                $builder->whereNotNull('comment');
            }]),
            'colors' => $product->colors()->pluck('color_name', 'colors.id')->toArray(),
            'sizes' => array_unique($product->colors()->pluck('size')->toArray()),
        ];
    }
}
