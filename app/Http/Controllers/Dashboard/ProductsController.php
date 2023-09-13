<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Department;
use App\Models\DepartmentProduct;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['colors'])->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', ['categories' => Category::where('status', 'active')->get(), 'departments' => $this->getDepartmentName()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            ...Product::rules(), 'product_image' => 'required|image|dimensions:min_width=100,min_height=100',
            'department' => [
                function ($attribute, $value, $fails) {
                    foreach ($value as $department) {
                        if (in_array($department, $this->getDepartmentName())) {
                            continue;
                        }
                        $fails("The departmnet $department not exsits in departments mnue");
                    }
                }
            ]
        ]);
        // dd($request->color);
        $data = $this->uploadImage($request);
        DB::beginTransaction();
        try {
            $productObject = Product::create($data);
            $this->createProductColor($data, $productObject);
            $this->createProductDepartment($data, $productObject);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return to_route('dashboard.products.index')->with('success', 'Added new product successfly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $departments = $this->getDepartmentName();
        foreach ($product->departments()->get() as $dept) {
            $productDepartment[] = $dept['department-name'];
        }
        $color_size = [];
        foreach ($product->colors as $color) {
            $color_size[$color->pivot->size][] = $color->color_name;
        }
        return view('dashboard.products.edit', compact('categories', 'product', 'departments', 'productDepartment', 'color_size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            ...Product::rules($product->id), 'product_image' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'department' => [
                function ($attribute, $value, $fails) {
                    foreach ($value as $department) {
                        if (in_array($department, $this->getDepartmentName())) {
                            continue;
                        }
                        $fails("The departmnet $department not exsits in departments mnue");
                    }
                }
            ]
        ], [
            'product_name' => 'this name (:attribute) alrdy exists',
        ]);
        if (!isset(($data = $this->uploadImage($request))['product_image'])) {
            $data['product_image'] = $product->product_image;
        } else {
            Storage::disk('public')->delete($product->product_image);
        }
        DB::beginTransaction();
        try {
            $product->update($data);
            ProductColor::where('product_id', $product->id)->delete();
            $this->createProductColor($data, $product);
            DepartmentProduct::where('product_id', $product->id)->delete();
            $this->createProductDepartment($data, $product);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return to_route('dashboard.products.index')->with('success', 'update the product successfly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('delete', 'deleted the product succfly and put in trash');
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('dashboard.products.trash', ['products' => $products]);
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id)->restore();
        return to_route('dashboard.products.index')->with('success', 'restore the product successfly');
    }
    public function forceDelete($id)
    {
        $product = Product::with('colors')->onlyTrashed()->findOrFail($id);
        $path = $product->product_image;
        // dd($product,$product->colors()->first()-);
        DB::beginTransaction();
        try {
            ProductColor::where('product_id', $id)->delete();
            DepartmentProduct::where('product_id', $id)->delete();
            $product->forceDelete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Storage::disk('public')->delete($path);
        return to_route('dashboard.products.index')->with('success', 'delete the products');
    }
    public function uploadImage(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->product_name)]);
        $data = $request->except('product_image');
        if ($request->hasFile('product_image')) {
            $data['product_image'] = Storage::disk('public')->append('uploads/products', $request->product_image);
        }
        return $data;
    }
    public function getDepartmentName(): array
    {
        $departments = Department::all();
        foreach ($departments as $department) {
            $deprt[] = $department['department-name'];
        }
        return $deprt;
    }
    public function createProductDepartment($data, $product)
    {
        foreach ($data['department'] as $department) {
            DepartmentProduct::create([
                'department_id' => Department::where('department-name', $department)->first()->id,
                'product_id' => $product->id
            ]);
        }
    }
    public function createProductColor($data, $product)
    {
        foreach ($data['color'] as $size => $colors) {
            foreach ($colors as $color) {
                $colorObject = Color::create(['color_name' => $color]);
                ProductColor::create([
                    'product_id' => $product->id,
                    'color_id' => $colorObject->id,
                    'size' => $size
                ]);
            }
        }
    }
    public function getDepartment(Category $category)
    {
        $departments = $category->departments()->get();
        foreach ($departments as $department) {
            $ids[] = [$department['department-name']];
        }
        return $ids;
    }
}
