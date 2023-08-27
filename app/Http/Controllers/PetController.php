<?php

namespace App\Http\Controllers;

use App\Actions\Pet\AddPetToOwnerAction;
use App\Actions\Pet\SearchPetVisitsAction;
use App\Actions\Pet\ShowPetAction;
use App\Actions\Pet\UpdatePetAction;
use App\Http\Requests\Pet\AddRequest;
use App\Http\Requests\Pet\EditRequest;
use App\Http\Requests\Pet\SearchRequest;
use App\Models\Pet;

class PetController extends Controller
{
    public function show(Pet $pet, ShowPetAction $showPetAction)
    {
        return $showPetAction($pet);
    }

    public function searchVisits(SearchRequest $request, Pet $pet, SearchPetVisitsAction $searchPetVisitsAction)
    {
       return $searchPetVisitsAction($pet, $request->validated());
    }

    public function add(AddRequest $request, AddPetToOwnerAction $addPetToOwnerAction)
    {
        return redirect()->route('owner.show', [
            'owner' => $addPetToOwnerAction($request->validated())->owner_id
        ]);
    }

    public function edit(Pet $pet)
    {
        return view('pet.edit', ['pet'=>$pet->load('kind', 'gender', 'owner')]);
    }

    public function update(EditRequest $request, Pet $pet, UpdatePetAction $updatePetAction)
    {
        return redirect()->route('pet.edit', [
            'pet' => $updatePetAction($pet, $request->validated())
        ]);
    }
}
