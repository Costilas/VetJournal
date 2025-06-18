<?php

namespace App\Services\Pet;

use App\Http\Requests\Pet\EditExistingPetRequest;
use App\Models\Pet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PetService
{
    /**
     * Retrieve a pet by ID with related models.
     *
     * @param int $id The ID of the pet to find
     * @param array $relations An array of related models to load
     * @return Pet The pet model if found, otherwise throws ModelNotFoundException
     */
    public function getPet(int $id, array $relations): Pet
    {
        return Pet::findOrFail($id)->load($relations);
    }

    /**
     * Update an existing pet's information.
     *
     * @param EditExistingPetRequest $editExistingPetRequest The request containing updated pet data
     * @param int $id The ID of the pet to update
     * @return bool True on successful update, otherwise false
     */
    public function updateExistingPet(EditExistingPetRequest $editExistingPetRequest, int $id): bool
    {
        $pet = Pet::findOrFail($id);
        $validated = $editExistingPetRequest->validated();

        if(key_exists('pet', $validated)) {
            $result = $pet->update($validated['pet']);
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * Retrieve pets that haven't had any visits.
     *
     * @param int $paginationLimit Number of pets per page
     * @return LengthAwarePaginator The paginated result set of pets
     */
    public function getPetsWithoutVisits(int $paginationLimit): LengthAwarePaginator
    {
        return Pet::with(['owner', 'kind', 'castration', 'gender'])->whereDoesntHave('visits')->paginate($paginationLimit);
    }
}
