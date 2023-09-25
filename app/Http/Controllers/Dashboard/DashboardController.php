<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::all()->take(7);
        $dept_name = '';
        $count = '';
        $color = '';
        foreach (Department::all() as $department) {
            $count .= $department->products()->count() . ',';
            $dept_name .= $department['department-name'] . ',';
        }
        return view('dashboard.dashboard', compact('orders', 'count', 'dept_name'));
    }
}
