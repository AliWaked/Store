<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'department-name', 'department-logo', 'slug'
    ];
    public static function rules($id = 0)
    {
        return [
            'department-name' => "required|string|min:3|max:255|unique:departments,department-name,$id",
            'department-logo' => 'required|image|dimensions:min_width=100,min_height=100',
        ];
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
