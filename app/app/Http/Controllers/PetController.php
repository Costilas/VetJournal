<?php

namespace App\Http\Controllers;

use App\Filters\PetVisitFilter;
use App\Http\Requests\AddPetRequest;
use App\Http\Requests\SearchPetVisitsRequest;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Support\Facades\Session;



class PetController extends Controller
{
    public function show($id)
    {
        $pet = Pet::with('owner', 'gender', 'kind', 'owner.pets')->findOrFail($id);
        $visits = $pet->visits()->paginate(1);

        return view('pet.show', compact('pet', 'visits'));
    }

    public function searchPetVisits(SearchPetVisitsRequest $request, $id)
    {
        $validatedSearchData = $request->validated();

        $pet = Pet::with('owner', 'gender', 'kind', 'owner.pets')
            ->findOrFail($id);

        if(!$pet->id||$pet->id!=$validatedSearchData['visit']['pet_id'])
        {
            return redirect()->back()
                ->withErrors('Скорее всего, вы пытались поменять идентификатор питомца вручную.');
        }

        $filter = new PetVisitFilter(Visit::class, $validatedSearchData);
        $visitIds = $filter->runFiltering();
        $visits = Visit::query()->whereKey($visitIds)->paginate(1)->withQueryString();

        return view('pet.show', compact('pet', 'visits'));
    }


    public function add(AddPetRequest $request)
    {
        $validatedData = $request->validated();

        if(!Owner::query()->find($validatedData['pet']['owner_id']))
        {
            return redirect()->back()
                ->withErrors('Скорее всего, вы пытались поменять идентификатор пользователя вручную.');
        }

        $newPet = Pet::create($validatedData['pet']);

        if($newPet->id)
        {
            Session::flash('success', "Питомец $newPet->name успешно добавлен");
        }
        return redirect()->route('owner.show', ['id'=>$validatedData['pet']['owner_id']]);
    }
}
