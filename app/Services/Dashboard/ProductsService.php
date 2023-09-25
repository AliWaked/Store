<?php

namespace App\Services\Dashboard;

use App\Models\Category;
use App\Models\Color;
use App\Models\Department;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsService
{
    /**
     * Get All Product
     *
     * @return LengthAwarePaginator
     */
    public function getProducts(): LengthAwarePaginator
    {
        return Product::paginate();
    }

    /**
     * Get Dependent Data For Create New Product
     *
     * @return array
     */
    public function getDataForCreateProduct(): array
    {
        return [
            'categories' => Category::status()->get(),
            'departments' => Department::all(),
        ];
    }

    /**
     * Create New Product
     *
     * @param array $data
     * @return Product
     */
    public function store(array $data): Product
    {
        $data = $this->getHandleData($data);
        $product = Product::create($data);
        $this->createProductColor($data, $product);
        return $product;
    }

    /**
     * Get Color And Size Avilable For This Product
     *
     * @param Product $product
     * @return array
     */
    public function getProductColorsAndSizes(Product $product): array
    {
        foreach ($product->colors as $color) {
            $color_size[$color->color_name->value][] = $color->pivot->size;
        }
        return $color_size;
    }

    /**
     * Get Dependent Data For Update Product
     *
     * @param Product $product
     * @return array
     */
    public function getDataForUpdateProduct(Product $product): array
    {
        foreach ($product->colors as $color) {
            $color_size[$color->pivot->size][] = $color->color_name->value;
        }
        return [
            'product' => $product,
            'categories' => Category::status()->get(),
            'departments' => Department::all(),
            'color_size' => $color_size ?? [],
        ];
    }

    /**
     * Update Product
     *
     * @param Product $product
     * @param array $data
     * @return string
     */
    public function update(Product $product, array $data): string
    {
        $path = $product->product_image;
        $product->update($this->getHandleData($data));
        $this->createProductColor($data, $product);
        return $path && in_array('product_image', $data) ? $path : '';
    }

    /**
     * Delete Product
     *
     * @param Product $product
     * @return boolean
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }

    /**
     * Get All Trashed Product
     *
     * @return LengthAwarePaginator
     */
    public function getTrashedProduct(): LengthAwarePaginator
    {
        return Product::onlyTrashed()->paginate();
    }

    /**
     * Restore Product
     *
     * @param string $id
     * @return Product
     */
    public function restore(string $id): bool
    {
        return Product::onlyTrashed()->findOrFail($id)->restore();
    }

    /**
     * Force Delete Product
     *
     * @param string $id
     * @return boolean
     */
    public function forceDelete(string $id): bool
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $path = $product->product_image;
        $bool = $product->forceDelete();
        Storage::disk(Product::DISK)->delete($path);
        return $bool;
    }

    /**
     * Get Clean Data For Create New Product Or Update Exists Product
     *
     * @param array $data
     * @return array
     */
    protected function getHandleData(array $data): array
    {
        $data['slug'] = Str::slug($data['product_name']);
        if (Arr::exists($data, 'product_image')) {
            $data['product_image'] = Storage::disk(Product::DISK)->append('uploads/products', $data['product_image']);
        }
        return $data;
    }

    /**
     * Create Items Color Product
     *
     * @param array $data
     * @param Product $product
     * @return void
     */
    protected function createProductColor(array $data, Product $product): void
    {
        $product->colors()->detach();
        foreach ($data['color'] as $size => $colors) {
            $colorId = [];
            foreach ($colors as $color) {
                $colorId = Color::where([
                    'color_name' => $color
                ])->value('id');
                $product->colors()->attach(
                    [
                        'color_id' => $colorId
                    ],
                    [
                        'size' => $size,
                    ]
                );
            }
        }
    }
}
