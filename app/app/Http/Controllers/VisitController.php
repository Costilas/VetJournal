<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function create(Request $request)
    {
        //Сделать валидацию
        Visit::create([
            'pet_id' => $request->pet_id,
            'visit_date' => $request->visit_date,
            'weight' => $request->weight,
            'temperature' => $request->temperature,
            'pre_diagnosis' => $request->pre_diagnosis,
            'visit_info' => $request->visit_info
        ]);

        return redirect(route('pet.show', ['id' => $request->pet_id]));
    }

    public function edit($id)
    {

        //Валидация и exceptions
        $visit = Visit::with('pet')->find($id);

        return view('visit.edit', compact('visit'));
    }

    public function update(Request $request)
    {
        //валидация, эксепшены

        $visit = Visit::find($request->visit_id);

        $visit->pet_id = $request->pet_id;
        $visit->visit_date = $request->visit_date;
        $visit->weight = $request->weight;
        $visit->temperature = $request->temperature;
        $visit->pre_diagnosis = $request->pre_diagnosis;
        $visit->visit_info = $request->visit_info;

        $visit->save();

        return redirect(route('visit.edit', ['id'=>$request->visit_id]));
    }
}
