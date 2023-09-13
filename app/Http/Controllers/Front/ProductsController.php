<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class ProductsController extends Controller
{
    public function show(Product $product)
    {
        $product = Product::with('colors')->where('id', $product->id)->first();
        $sizes = ProductColor::where('product_id', $product->id)->get()->groupBy('size')->toArray();
        return view('front.product.show', compact('product', 'sizes'));
    }
    public function addToFavourite(Product $product)
    {
        $user_id = auth()->user()->id;
        $favourite = ($productUser = ProductUser::where('user_id', $user_id)->where('product_id', $product->id))->first();
        if (!isset($favourite)) {
            ProductUser::create([
                'product_id' => $product->id,
                'user_id' => $user_id,
                'favourite' => 'yes',
            ]);
            return;
        }
        if ($favourite->favourite == null || $favourite->favourite == 'no') {
            $productUser->update(['favourite' => 'yes']);
        }
        return;
    }
    public function removeToFavourite(Product $product)
    {
        $user_id = auth()->user()->id;
        $favourite = ($productUser = ProductUser::where('user_id', $user_id)->where('product_id', $product->id))->first();
        if (isset($favourite)) {
            $productUser->update(['favourite' => 'no']);
        }
    }
    public function addReview(Request $request, Product $product)
    {
        $user_id = auth()->user()->id;
        $request->validate([
            'comment' => 'required|string',
            'stars' => "required|integer|gt:0|lt:6",
        ]);
        $review = ($productUser = ProductUser::where('user_id', $user_id)->where('product_id', $product->id))->first();
        if (!isset($review)) {
            ProductUser::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'comment' => $request->comment,
                'reviews' => $request->stars,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $productUser->update([
                'comment' => $request->comment,
                'reviews' => $request->stars,
                'updated_at' => Carbon::now(),
            ]);
        }
        foreach ($product->users()->get() as $user) {
            $reviews[] = [$user->name, $user->pivot->reviews, $user->pivot->comment, \Carbon\Carbon::parse($user->pivot->updated_at)->diffForHumans()];
        }
        return $reviews;
    }
}
