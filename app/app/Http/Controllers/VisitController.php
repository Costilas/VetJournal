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
}
