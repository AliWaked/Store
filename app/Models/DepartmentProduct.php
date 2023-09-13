<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentProduct extends Pivot
{
    use HasFactory;
    public $table = 'department_product';
    public $timestamps = false;
    // public function departments()
    // {
    //     return $this->belongsToMany(Department::class);
    // }
}
