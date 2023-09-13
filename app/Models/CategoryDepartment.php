<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryDepartment extends Pivot
{
    use HasFactory;
    public $table = 'category_department';
    protected $fillable = [
        'category_id', 'department_id',
    ];
}
