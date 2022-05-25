<?php

namespace App\Actions\Card;

use App\Models\Owner;

class SearchCardAction
{
    public function __invoke(array $validatedData)
    {
        return Owner::filter($validatedData)
            ->with('pets.kind')
            ->paginate(5)
            ->withQueryString();
    }
}
