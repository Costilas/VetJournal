<?php

namespace App\Services\Pet;

use App\Http\Requests\Pet\EditExistingPetRequest;
use App\Http\Requests\Pet\SearchPetVisitsRequest;
use App\Models\Pet;

class PetService
{
    public function getPet(int $id, array $relations): Pet
    {
        return Pet::findOrFail($id)->load($relations);
    }

    public function getPetVisits(Pet $pet, int $paginationLimit, ?SearchPetVisitsRequest $request = null)
    {
        $return = $pet->visits();

        if(!empty($request)) {
            $return->filter($request->validated());
        }

        return $return->with('user')
            ->latest('visit_date')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    public function updateExistingPet(EditExistingPetRequest $editExistingPetRequest, int $id): bool
    {
        $pet = Pet::findOrFail($id);

        return $pet->update($editExistingPetRequest->validated());
    }

    public function getPetsWithoutVisits(int $paginationLimit)
    {
        return Pet::with(['owner', 'kind', 'castration', 'gender'])->whereDoesntHave('visits')->paginate($paginationLimit);
    }
}
