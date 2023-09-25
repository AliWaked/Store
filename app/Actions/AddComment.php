<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AddComment
{

    public function store(Product $product, array $data): array
    {
        $clean_data = [
            'comment' => $data['comment'],
            'reviews' => $data['stars'],
            'updated_at' => Carbon::now(),
        ];
        Auth::user()->products()->syncWithoutDetaching([
            $product->id => $clean_data,
        ]);
        $clean_data['user_name'] = Auth::user()->name;
        $clean_data['user_id'] = Auth::user()->id;
        $clean_data['product_id'] = $product->id;
        $clean_data['updated_at'] = $clean_data['updated_at']->diffForHumans();
        return $clean_data;
    }
}
