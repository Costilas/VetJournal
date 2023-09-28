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
    public function getOwner(int $id): Owner
    {
        return Owner::findOrFail($id);
    }

    public function searchExistingOwnerWithPets(SearchExistingOwnerRequest $searchExistingCardRequest, int $paginationLimit)
    {
        return Owner::filter($searchExistingCardRequest->validated())
            ->with('pets.kind')
            ->latest('updated_at')
            ->paginate($paginationLimit)
            ->withQueryString();
    }

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

    public function getOwnerPets(Owner $owner, int $paginationLimit)
    {
        return $owner->pets()->with(['kind', 'gender', 'castration'])->paginate($paginationLimit);
    }

    public function updateExistingOwner(EditExistingOwnerRequest $editExistingOwnerRequest, int $id): bool
    {
        $owner = Owner::findOrFail($id);

        return $owner->update($editExistingOwnerRequest->validated());
    }

}
