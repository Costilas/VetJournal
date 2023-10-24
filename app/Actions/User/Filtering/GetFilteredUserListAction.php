<?php

namespace App\Actions\User\Filtering;

use App\Models\User;

class GetFilteredUserListAction
{
    public function __invoke(array $validatedData)
    {
        return User::exceptRoot()->filter($validatedData)->paginate(5)->withQueryString();
    }
}
