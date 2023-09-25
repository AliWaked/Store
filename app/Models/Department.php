<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    const DISK = 'public';
    protected $fillable = [
        'department_name', 'department_logo', 'slug'
    ];
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk(self::DISK)->url($this->department_logo),
        );
    }
}
