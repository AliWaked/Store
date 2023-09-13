<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['color_name'];
    public $timestamps = false;
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color')->using(ProductColor::class)->withPivot(['size']);
    }
}
