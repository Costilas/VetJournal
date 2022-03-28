<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;


class PetController extends Controller
{
    public function show($id, Request $request)
    {
        //Валидация и вынесение в контроллер + тестирование
        $pet = Pet::with('owner', 'gender', 'kind', 'owner.pets')->findOrFail($id);
        $visits = VisitController::searchPetVisits($request, $id);

        return view('pet.show', compact('pet', 'visits'));
    }


    public function add(Request $request)
    {
        //Валидация
        $newPet = Pet::create([
            'pet_name' => $request->pet_name,
            'owner_id' => $request->owner_id,
            'kind_id' => $request->kind,
            'gender_id' => $request->gender,
            'birth' => $request->birth
        ]);

        return redirect(route('owner.show', ['id'=>$request->owner_id]));
    }
}
