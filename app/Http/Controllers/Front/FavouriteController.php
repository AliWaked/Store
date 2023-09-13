<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index() {
    $products_ids = array_keys(ProductUser::where('user_id',auth()->user()->id)->where('favourite','yes')->get()->groupBy('product_id')->toArray());
    $products = Product::whereIn('id',$products_ids)->get();
        return view('front.favourite.index',compact('products'));
    }
}
