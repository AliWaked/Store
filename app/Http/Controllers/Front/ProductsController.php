<?php

namespace App\Http\Controllers\Front;

use App\Events\AddNewComment;
use App\Services\Front\ProductService;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function PHPUnit\Framework\isNull;

class ProductsController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        //
    }
    public function index(Request $request, Department $department): View
    {
        return view('front.product.index', $this->productService->getProducts($department, $request->all()));
    }
    public function show(Product $product): View
    {
    // dd($this->productService->getDataForShowProduct($product));
        return view('front.product.show', $this->productService->getDataForShowProduct($product));
    }

    public function getColorSizeForProduct(Request $request, Department $department): array
    {
        return $this->productService->getColorSizeForProduct($department, $request->all());
    }
}
