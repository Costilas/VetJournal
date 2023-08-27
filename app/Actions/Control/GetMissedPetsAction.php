<?php

namespace App\Actions\Control;

use App\Models\Pet;

class GetMissedPetsAction
{
    public function __invoke()
    {
        return Pet::with('owner', 'kind', 'castration', 'gender')->whereDoesntHave('visits')->paginate(10);
    }
}
