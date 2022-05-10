<?php

namespace App\Actions\Card;

use App\Actions\Action;
use App\Models\Owner;

class SearchCardAction extends Action
{
    public function __invoke(array $validatedData)
    {
        return Owner::filter($validatedData)
            ->with('pets.kind')
            ->paginate(1)
            ->withQueryString();
    }
}
