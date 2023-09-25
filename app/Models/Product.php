<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const DISK = 'public';

    protected $fillable = [
        'product_name',
        'category_id',
        'price',
        'slug',
        'product_image',
        'department_id',
    ];

    protected static function booted(): void
    {
        static::forceDeleted(function (Product $product) {
            static::deleteImage($product->product_image);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_color')->withPivot(['size']);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'porduct_user')->withPivot(['is_favourite', 'reviews', 'comment', 'updated_at']);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk(self::DISK)->url($this->product_image),
        );
    }

    public function scopeSearch(Builder $builder, ?array $data): void
    {
        $builder->when($data['category_name'] ?? false, function (Builder $builder, string $value) use ($data) {
            $builder->where('category_id', $value);
            $builder->when($data['size_name'] ?? false, function (Builder $builder, string $value) use ($data) {
                $builder->whereHas('colors', function (Builder $builder) use ($value, $data) {
                    $builder->where('product_color.size', $value);
                    $builder->when($data['color_name'] ?? false, function (Builder $builder, string $value) {
                        $builder->where('colors.color_name', $value);
                    });
                });
            });
        });
    }

    public static function deleteImage(string $path): bool
    {
        return Storage::disk(static::DISK)->delete($path);
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        $builder->when($filter['size'] ?? false, function (Builder $builder, $size) use ($filter) {
            $builder->where('size', $size);
            $builder->when($filter['color'] ?? false, function (Builder $builder, $color) {
                $builder->where('color', $color);
            });
        });
    }
}
