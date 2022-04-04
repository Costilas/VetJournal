<?php

namespace App\Http\Controllers;

use App\Http\Requests\Visit\AddVisitRequest;
use App\Http\Requests\Visit\EditVisitRequest;
use App\Http\Requests\Visit\SearchVisitsRequest;
use App\Models\Visit;
use Illuminate\Support\Facades\Session;

class VisitController extends Controller
{
    public function index()
    {
        return view('visit.index');
    }

    public function search(SearchVisitsRequest $request) {

        $query = Visit::with('pet');
        if($request->has('visitSearch')&&!$request->has('visitSearchByDate')) {
            if($request->has('yesterday'))
            {
                $query->where('visit_date','=', date('Y-m-d', strtotime('-1 day')));
            }
            if ($request->has('today'))
            {
                $query->where('visit_date', '=', date('Y-m-d'));
            }
        }
        else {
            $query->whereBetween('visit_date', [$request->visit_date_start, $request->visit_date_end]);
        }
        $visits = $query->orderBy('visit_date', 'DESC')
            ->paginate(25)
            ->withQueryString();

        return view('visit.index', compact('visits'));
    }

    public function create(AddVisitRequest $request)
    {
        $validatedVisitData = $request->validated();
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

        $visit->weight = $updateData['weight'];
        $visit->temperature = $updateData['temperature'];
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
