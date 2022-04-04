<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pet\AddPetRequest;
use App\Http\Requests\Visit\SearchPetVisitsRequest;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class PetController extends Controller
{
    public function show($id, Request $request)
    {
        $pet = Pet::with('owner.pets', 'gender', 'kind')->findOrFail($id);
        if(!empty($request)&&$request->has('visits'))
        {
            $validated = $request->validate([
                "visits" => [
                    'required',
                    'array',
                    'min:2',
                    'max:2'
                ],
                "visits.from" => [
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d'),
                ],
                "visits.to" => [
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d'),
                ],
            ]);
            $validated['pet_id'] = $id;
            $visits =  Visit::filter($validated)->paginate(1)->withQueryString();

        } else {
            $visits = $pet->visits()->paginate(1)->withQueryString();
        }

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
