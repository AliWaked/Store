<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'category_logo', 'parent_id', 'slug', 'status',
    ];
    public static function rules($id = 0)
    {
        return [
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'status' => 'required|string|in:active,archive',
            'parent_id' => 'nullable|int|exists:categories,id',
            // 'category_logo' => 'required|image',
            'department' => 'required|array',
        ];
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault(['name'=>'_']);
    }
    public function products() {
        return $this->hasMany(Product::class,'category_id');
    }
    public function departments() {
        return $this->belongsToMany(Department::class);
    }
}
