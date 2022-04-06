<?php

namespace App\Http\Controllers;

use App\Http\Requests\Visit\AddVisitRequest;
use App\Http\Requests\Visit\EditVisitRequest;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('visits')||$request->has('search'))
        {
            $validated = $request->validate([
                "visits" => [
                    'sometimes',
                    'required',
                    'array',
                    'min:2',
                    'max:2'
                ],
                "visits.from" => [
                    'sometimes',
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d 00:00:01'),
                ],
                "visits.to" => [
                    'sometimes',
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d 23:59:59'),
                ],
                "search" => [
                    'sometimes',
                    'required',
                    'alpha',
                    Rule::in(['today', 'week', 'yesterday']),
                ]
            ]);

            $visits = Visit::filter($validated)->with('pet')->orderBy('id', 'DESC')->paginate(20)->withQueryString();
        } else {
            $visits = Visit::filter(['search'=>'today'])->with('pet')->orderBy('id', 'DESC')->paginate(20)->withQueryString();
        }

        return view('visit.index', compact('visits'));
    }

    public function create(AddVisitRequest $request)
    {
        $validatedVisitData = $request->validated();
        $validatedVisitData['visit']['weight'] = Visit::weightNormalize($validatedVisitData['visit']['weight']);
        $validatedVisitData['visit']['temperature'] = Visit::temperatureNormalize($validatedVisitData['visit']['temperature']);
        $newVisit = Visit::create($validatedVisitData['visit']);

        if($newVisit->id)
        {
            Session::flash('success', "Прием успешно добавлен!");
        }

        return redirect()->route('pet.show', ['id' => $validatedVisitData['visit']['pet_id']]);
    }

    public function edit($id)
    {
        $visit = Visit::with('pet')->find($id);

        return view('visit.edit', compact('visit'));
    }

    public function update(EditVisitRequest $request)
    {
        $validatedUpdateData = $request->validated();

        $visitId = $validatedUpdateData['visit']['visit_id'];
        $updateData = array_diff_assoc($validatedUpdateData['visit'], ['visit_id'=>$visitId]);

        $visit = Visit::find($visitId);
        $visit->weight = Visit::weightNormalize($updateData['weight']);
        $visit->temperature = Visit::temperatureNormalize($updateData['temperature']);
        $visit->pre_diagnosis = $updateData['pre_diagnosis'];
        $visit->visit_info = $updateData['visit_info'];

        $save = $visit->save();

        if($save)
        {
            Session::flash('success', "Прием успешно изменен!");
        }

        return redirect(route('visit.edit', ['id'=>$visitId]));
    }
}
