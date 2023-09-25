<?php

namespace App\Models;

use App\Enums\Colors;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Color extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'color_name'
    ];
    protected $casts = [
        'color_name' => Colors::class,
    ];
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_color')->withPivot(['size']);
    }
    
}
