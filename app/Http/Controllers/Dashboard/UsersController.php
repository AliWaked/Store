<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\GetUsers;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function __invoke(GetUsers $getUsers): View
    {
        return view('dashboard.users.index', [
            'users' => $getUsers->all(),
        ]);
    }
}
