<?php

namespace App\Actions\Pet;

use App\Models\Pet;

class ShowPetAction
{
    public function __invoke(Pet $pet)
    {
        $pet->load('gender', 'kind', 'owner', 'castration');

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $pet->visits()
                ->with('user')
                ->latest('visit_date')
                ->paginate(5)
                ->withQueryString()
        ]);
    }
}
