<?php

namespace App\Http\Controllers;

use App\Actions\Common\DescribeFilterAction;
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

    public function searchVisits(SearchRequest $request, Pet $pet, SearchPetVisitsAction $searchPetVisitsAction, DescribeFilterAction $filterAction)
    {
        $validatedData = $request->validated();

       return $searchPetVisitsAction($pet, $filterAction, $validatedData);
    }

    public function add(AddRequest $request, AddPetToOwnerAction $addPetToOwnerAction)
    {
        $validatedData = $request->validated();

        return $addPetToOwnerAction($validatedData);
    }

    public function edit(Pet $pet)
    {
        $pet->load('kind', 'gender', 'owner');

        return view('pet.edit', compact('pet'));
    }

    public function update(EditRequest $request, Pet $pet, UpdatePetAction $updatePetAction)
    {
        $validatedData = $request->validated();

        return $updatePetAction($pet, $validatedData);
    }
}
