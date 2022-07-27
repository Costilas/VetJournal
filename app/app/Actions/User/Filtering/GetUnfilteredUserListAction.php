<?php

namespace App\Actions\User\Filtering;

use App\Models\User;

class GetUnfilteredUserListAction
{
    public function __invoke()
    {
        return User::with('roles')->paginate(5)->withQueryString();
    }
}
