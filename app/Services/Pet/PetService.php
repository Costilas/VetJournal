<?php

namespace App\Services\Pet;

use App\Models\Pet;

class PetService
{
    public function getPet(int $id, array $relations): Pet
    {
        return Pet::findOrFail($id)->load($relations);
    }

    public function getPetVisits(Pet $pet, int $paginationLimit)
    {
        return $pet->visits()
            ->with('user')
            ->latest('visit_date')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    public function getPetsWithoutVisits(int $paginationLimit)
    {
        return Pet::with(['owner', 'kind', 'castration', 'gender'])->whereDoesntHave('visits')->paginate($paginationLimit);
    }
}
