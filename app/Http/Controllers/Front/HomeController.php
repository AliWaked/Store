<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
    // dd(Department::take(3)->first()->image);
        return view('front.home', [
            'departments' => Department::take(3)->get(),
            'products' => Product::all(),
        ]);
    }
}
