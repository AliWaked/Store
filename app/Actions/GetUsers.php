<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUsers
{
    /**
     * Get All Users
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return User::where('is_admin', false)->paginate();
    }
}
