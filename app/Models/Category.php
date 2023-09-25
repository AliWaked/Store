<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'category_logo', 'parent_id', 'slug', 'status',
    ];
    protected $casts = [
        'status' => CategoryStatus::class,
    ];
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault(['name' => '_']);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }
    public function scopeStatus(Builder $builder): void
    {
        $builder->whereStatus(CategoryStatus::ACTIVE->value);
    }
}
