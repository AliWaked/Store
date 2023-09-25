<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUser;
use App\Services\Front\FavouriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class FavouriteController extends Controller
{
    public function __construct(protected FavouriteService $favouriteService)
    {
        //
    }
    public function index(): View
    {
        return view('front.favourite.index', [
            'products' => Auth::user()->products()->wherePivot('is_favourite', true)->get(),
        ]);
    }
    public function store(Product $product): JsonResponse
    {
        $this->favouriteService->store($product);
        return Response::json([
            'message' => 'add to favourite success',
        ]);
    }
    public function destroy(Product $product): JsonResponse
    {
        $this->favouriteService->destroy($product);
        return Response::json([
            'message' => 'updated success',
        ]);
    }
}
