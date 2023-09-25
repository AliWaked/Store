<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\CategoryStatus;
use App\Enums\Colors;
use App\Events\NewProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Department;
use App\Models\DepartmentProduct;
use App\Models\Product;
use App\Models\ProductColor;
use App\Services\Dashboard\ProductsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function __construct(protected ProductsService $productsService)
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard.products.index', [
            'products' => $this->productsService->getProducts(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.products.create', $this->productsService->getDataForCreateProduct());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $product = $this->productsService->store($request->validated());
            DB::commit();
            NewProduct::dispatch($product);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return to_route('dashboard.products.index')->with('success', __('Added new product successfly'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('dashboard.products.show', [
            'product' => $product,
            'data' => $this->productsService->getProductColorsAndSizes($product),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {

        return view('dashboard.products.edit', $this->productsService->getDataForUpdateProduct($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $path = $this->productsService->update($product, $request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Product::deleteImage($path);
        return to_route('dashboard.products.index')->with('success', 'update the product successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productsService->delete($product);
        return redirect()->back()->with('success', __('deleted the product succfly and put in trash'));
    }
    public function trash(): View
    {
        return view('dashboard.products.trash', [
            'products' => $this->productsService->getTrashedProduct(),
        ]);
    }
    public function restore($id): RedirectResponse
    {
        $this->productsService->restore($id);
        return to_route('dashboard.products.index')->with('success', __('restore the product successfly'));
    }
    public function forceDelete(string $id): RedirectResponse
    {
        $this->productsService->forceDelete($id);
        return to_route('dashboard.products.index')->with('success', __('delete the products'));
    }
    public function getDepartment(Category $category)
    {
        return  $category->departments()->pluck('department_name', 'id')->toArray();
    }
}
