<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductUser extends Pivot
{
    use HasFactory;
    public $table = 'porduct_user';
    public $timestamps = false;
    protected $fillable = [
        'product_id', 'user_id', 'favourite', 'reviews', 'commit', 'updated_at'
    ];
}
