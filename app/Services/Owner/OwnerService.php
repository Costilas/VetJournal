<?php

namespace App\Services\Owner;

use App\Http\Requests\Owner\SearchExistingOwnerRequest;
use App\Http\Requests\Owner\CreateNewOwnerRequest;
use App\Http\Requests\Owner\EditExistingOwnerRequest;
use App\Models\Owner;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OwnerService
{
    public function searchExistingOwnerWithPets(SearchExistingOwnerRequest $searchExistingCardRequest)
    {
        return Owner::filter($searchExistingCardRequest->validated())
            ->with('pets.kind')
            ->latest('updated_at')
            ->paginate(5)
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

    public function editExistingOwner(Owner $owner, EditExistingOwnerRequest $editExistingOwnerRequest): bool
    {
        return $owner->update($editExistingOwnerRequest->validated());
    }

}
