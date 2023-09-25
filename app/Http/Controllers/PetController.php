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
use App\Services\Pet\PetService;

class PetController extends Controller
{
    public function __construct(
        protected PetService $petService
    ){}

    public function show(int $id)
    {
        $pet = $this->petService->getPet($id, ['gender', 'kind', 'owner', 'castration']);
        $petVisits = $this->petService->getPetVisits($pet, 5);

        return view('pet.show', [
            'pet' => $pet,
            'owner' => $pet->owner,
            'visits' => $petVisits
        ]);
    }

    //TODO
    public function searchVisits(SearchRequest $request, Pet $pet, SearchPetVisitsAction $searchPetVisitsAction)
    {
       return $searchPetVisitsAction($pet, $request->validated());
    }

    //TODO
    public function edit(Pet $pet)
    {
        return view('pet.edit', ['pet'=>$pet->load('kind', 'gender', 'owner')]);
    }

    //TODO
    public function update(EditRequest $request, Pet $pet, UpdatePetAction $updatePetAction)
    {
        return redirect()->route('pet.edit', [
            'pet' => $updatePetAction($pet, $request->validated())
        ]);
    }
}
