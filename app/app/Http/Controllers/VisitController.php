<?php

namespace App\Http\Controllers;

use App\Http\Requests\Visit\AddRequest;
use App\Http\Requests\Visit\EditRequest;
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
            $validatedRequest = $request->validate([
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

            $query = Visit::filter($validatedRequest);;
        } else {
            $query = Visit::filter(['search'=>'today']);;
        }
        $visits = $query->with('pet', 'user')->orderBy('id', 'DESC')->paginate(20)->withQueryString();

        return view('visit.index', compact('visits'));
    }

    public function create(AddRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
        $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
        $newVisit = Visit::create($validatedRequest['visit']);

        if($newVisit->id)
        {
            Session::flash('success', "Прием успешно добавлен!");
        }

        return redirect()->route('pet.show', ['id' => $validatedRequest['visit']['pet_id']]);
    }

    public function edit($id)
    {
        $visit = Visit::with('pet')->find($id);

        return view('visit.edit', compact('visit'));
    }

    public function update(EditRequest $request, $id)
    {
        $validatedRequest = $request->validated();

        $visit = Visit::find($id);
        $visit->weight = Visit::weightNormalize($validatedRequest['visit']['weight']);
        $visit->temperature = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
        $visit->pre_diagnosis = $validatedRequest['visit']['pre_diagnosis'];
        $visit->visit_info = $validatedRequest['visit']['visit_info'];
        $visit->user_id = $validatedRequest['visit']['doctor_id'];

        $save = $visit->save();
        if($save)
        {
            Session::flash('success', "Прием успешно изменен!");
        }

        return redirect(route('visit.edit', ['id'=>$id]));
    }
}
