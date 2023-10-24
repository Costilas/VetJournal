<?php

namespace App\Services\Pet;

use App\Http\Requests\Pet\EditExistingPetRequest;
use App\Http\Requests\Pet\SearchPetVisitsRequest;
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
     * Retrieve visits of a specific pet with optional filtering.
     *
     * @param Pet $pet The Pet model
     * @param int $paginationLimit Number of visits per page
     * @param SearchPetVisitsRequest|null $request The request containing filters, if any
     * @return LengthAwarePaginator The paginated visits of the pet
     */
    public function getPetVisits(Pet $pet, int $paginationLimit, ?SearchPetVisitsRequest $request = null): LengthAwarePaginator
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

        return $pet->update($editExistingPetRequest->validated());
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
