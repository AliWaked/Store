<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_name', 'category_id', 'price', 'slug', 'product_image'
    ];
    public static function rules($id = 0)
    {
        return [
            'product_name' => "required|string|min:3|max:255|unique:products,product_name,$id",
            'color' => [
                function ($attribute, $value, $fails) {
                    foreach ($value as $size => $colors) {
                        if (!in_array($size, ['xl', 'l', 'm', 's'])) {
                            $fails("this size ($size) not found");
                        }
                        foreach ($colors as $color) {
                            if (in_array($color, ['red', 'blue', 'green', 'yellow', 'black', 'white', 'orange', 'gray'])) {
                                continue;
                            }
                            $fails('this size is not found');
                        }
                    }
                }
            ],
            'category_id' => 'required|integer|exists:categories,id',
            // 'product_image' => 'required|image|dimensions:min_height=100,min_width=100',
            'price' => 'required|numeric|gt:0',
            'department' => 'required|array',
        ];
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color', 'product_id', 'color_id', 'id', 'id')->using(ProductColor::class)->withPivot(['size']);
    }
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'porduct_user')->withPivot(['favourite','reviews','comment','updated_at']);
    }

    public function scopeFilter(Builder $builder, $filter)
    {
        $builder->when($filter['size'] ?? false, function (Builder $builder, $size) use ($filter) {
            $builder->where('size', $size);
            $builder->when($filter['color'] ?? false, function (Builder $builder, $color) {
                $builder->where('color', $color);
                // $builder->whereIn()
            });
        });
    }
}
