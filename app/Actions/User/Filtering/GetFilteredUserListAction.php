<?php

namespace App\Actions\User\Filtering;

use App\Models\User;

class GetFilteredUserListAction
{
    public function __invoke(array $validatedData)
    {
        return User::filter($validatedData)->with('roles')->paginate(5)->withQueryString();
    }
}
