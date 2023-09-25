<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductColor extends Pivot
{
    use HasFactory;
    protected $table = 'product_color'; // 'product_colors' => by default
    protected $fillable = [
        'product_id',
        'color_id',
        'size',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
