<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;


class PetController extends Controller
{
    public function show($id, Request $request)
    {
        $pet = Pet::with('owner', 'gender', 'kind', 'owner.pets')->findOrFail($id);

        //Валидация и вынесение в контроллер + тестирование
        if ($request->query->has('visit_search')) {
            $visits = Visit::where('pet_id', '=', $id)
                ->whereBetween('visit_date', [$request->visit_date_start, $request->visit_date_end])
                ->orderBy('visit_date', 'DESC')
                ->paginate(5)
                ->withQueryString();
        } else {
            $visits = Visit::where('pet_id', '=', $id)
                ->orderBy('visit_date', 'DESC')
                ->paginate(5)
                ->withQueryString();
        }

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
