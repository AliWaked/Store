<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
    $departments = Department::all();
    // dd($departments->first()->categories);
        return view('front.home',compact('departments'));
    }
}
