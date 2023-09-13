<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(Request $request, Department $department)
    {
        $categories = Department::with('categories')->where('id', $department->id)->first()->categories()->get();
        $products = Department::with(['products'])->where('id', $department->id)->first()->products()->get();
        if ($category_id = $request->category_name) {
            $products = $products->where('category_id', $category_id);
            if ($size = $request->size_name) {
                $porduct_ids = array_keys($products->groupBy('id')->toArray());
                $product_ids = array_keys(ProductColor::whereIn('product_id', $porduct_ids)->where('size', $size)->get()->groupBy('product_id')->toArray());
                $products = Product::whereIn('id', $porduct_ids)->get();
                // $product_ids = $products->first()->colors()->get()->first()->pivot->select('product_id')->where('size', $size)->get(); # 2foreach
                if ($color = $request->color_name) {
                    $colors_ids = array_keys(Color::where('color_name', $color)->get()->groupBy('id')->toArray());
                    $product_ids = array_keys(ProductColor::whereIn('product_id', $product_ids)->whereIn('color_id', $colors_ids)->get()->groupBy('product_id')->toArray());
                    $products = Product::whereIn('id', $product_ids)->get();
                }
                // dd($request, $products, $products->first()->colors()->get()->first()->pivot->select('product_id')->where('size', $size)->get());
            }
        }
        // $product = $products->colors()->where('color_name', 'green')->first()->pivot->where('size', 'xl')->select('product_id')->get()->toArray();
        // dd($products->first()->get(), $product);
        $values = ['category'=>$request->category_name,'size'=>$request->size_name,'color' => $request->color_name];
        return view('front.departments.show', compact('department', 'categories', 'products','values'));
    }
    public function show()
    {
    }
    public function getColorSize(Request $request, Department $department)
    {
        $products = $department->categories()->where('id', +$request->category)->first()->products()->select('id')->get();
        if (!$request->size) {
            foreach ($products as $product) {
                $sizes = ProductColor::select('size')->where('product_id', $product->id)->groupBy('size')->get();
                foreach ($sizes as $size) {
                    $result[] = $size->size;
                }
            }
            return array_values(array_unique($result));
        }
        foreach ($products as $product) {
            $colorIds = ProductColor::select('color_id')->where('product_id', $product->id)->where('size', $request->size)->groupBy('color_id')->get();
            foreach ($colorIds as $colorId) {
                $colorName[] = Color::where('id', $colorId->color_id)->first()->color_name;
            }
        }
        return array_values(array_unique($colorName));
    }
}
