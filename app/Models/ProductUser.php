<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class ProductUser extends Pivot
{
    use HasFactory;
    public $table = 'porduct_user';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'user_id',
        'is_favourite',
        'reviews',
        'comment',
        'updated_at',
    ];
    protected $casts = [
        'is_favourite' => 'boolean',
        'reviews' => 'integer',
    ];
    // protected static function booted(): void
    // {
    //     static::addGlobalScope(function (Builder $builder) {
    //         $builder->where('user_id', Auth::id());
    //     });
    // }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
