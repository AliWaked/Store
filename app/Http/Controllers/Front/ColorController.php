<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Department;
use App\Models\Product;
use App\Services\Front\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct(protected ColorService $colorService)
    {
        //
    }
    public function getSizeForProduct(Product $product, Color $color): array
    {
        return $this->colorService->getSizeForProduct($product, $color);
    }
    public function getColorSize(Request $request, Department $department): array
    {
        return $this->colorService->getColorSize($department, $request->all());
    }
}
