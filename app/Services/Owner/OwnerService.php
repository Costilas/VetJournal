<?php

namespace App\Services\Owner;

use App\Http\Requests\Owner\SearchExistingOwnerRequest;
use App\Http\Requests\Owner\CreateNewOwnerRequest;
use App\Http\Requests\Owner\EditExistingOwnerRequest;
use App\Http\Requests\Owner\AttachNewPetsToOwnerRequest;
use App\Models\Owner;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OwnerService
{
    /**
     * Retrieve an owner by ID.
     *
     * @param int $id The ID of the owner to find
     * @return Owner The owner model if found, otherwise throws ModelNotFoundException
     */
    public function getOwner(int $id): Owner
    {
        return Owner::findOrFail($id);
    }

    /**
     * Search existing owners with their pets using filters.
     *
     * @param SearchExistingOwnerRequest $searchExistingCardRequest The request containing search filters
     * @param int $paginationLimit Number of items per page
     * @return mixed The paginated result set
     */
    public function searchExistingOwnerWithPets(SearchExistingOwnerRequest $searchExistingCardRequest, int $paginationLimit): mixed
    {
        return Owner::filter($searchExistingCardRequest->validated())
            ->with('pets.kind')
            ->latest('updated_at')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

    /**
     * Create a new owner along with their pets.
     *
     * @param CreateNewOwnerRequest $createNewOwnerRequest The request containing owner and pet data
     * @return Owner|null The newly created owner model, or null on failure
     */
    public function createNewOwnerWithPets(CreateNewOwnerRequest $createNewOwnerRequest): ?Owner
    {
        DB::beginTransaction();

        try {
            $validatedData = $createNewOwnerRequest->validated();
            $newOwner = Owner::create($validatedData['owner']);
            $newOwner->pets()->createMany($validatedData['pets']);

            DB::commit();
        }catch (Exception $e) {
            Log::debug($e->getMessage());
            DB::rollBack();

            $newOwner = null;
        }

        return $newOwner;
    }

    /**
     * Attach new pets to an existing owner.
     *
     * @param AttachNewPetsToOwnerRequest $attachNewPetsToOwnerRequest The request containing new pets data
     * @param int $id The ID of the existing owner
     * @return bool True on successful attachment, otherwise false
     */
    public function attachNewPetsToOwner(AttachNewPetsToOwnerRequest $attachNewPetsToOwnerRequest, int $id): bool
    {
        try {
            $validatedData = $attachNewPetsToOwnerRequest->validated();
            $existingOwner = Owner::findOrFail($id);
            $attachResult = true;

            DB::beginTransaction();

            $existingOwner->pets()->createMany($validatedData['pets']);

            DB::commit();
        }catch (Exception $e) {
            Log::debug($e->getMessage());
            DB::rollBack();
            $attachResult = false;
        }

        return $attachResult;
    }

    /**
     * Get paginated pets of a specific owner.
     *
     * @param Owner $owner The owner model
     * @param int $paginationLimit Number of items per page
     * @return mixed The paginated result set
     */
    public function getOwnerPets(Owner $owner, int $paginationLimit)
    {
        return $owner->pets()->with(['kind', 'gender', 'castration'])->paginate($paginationLimit);
    }

    /**
     * Update an existing owner's information.
     *
     * @param EditExistingOwnerRequest $editExistingOwnerRequest The request containing updated owner data
     * @param int $id The ID of the owner to update
     * @return bool True on successful update, otherwise false
     */
    public function updateExistingOwner(EditExistingOwnerRequest $editExistingOwnerRequest, int $id): bool
    {
        $owner = Owner::findOrFail($id);

        return $owner->update($editExistingOwnerRequest->validated());
    }
}
