<?php

namespace App\Http\Controllers;

use App\Helpers\FilterConditionDescriber;
use App\Http\Requests\Visit\CreateRequest;
use App\Http\Requests\Visit\EditRequest;
use App\Http\Requests\Visit\SearchRequest;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class VisitController extends Controller
{
    public function index(FilterConditionDescriber $conditionDescriber)
    {
        $searchDateRange = ['search'=> [
                'from'=>Carbon::create('today')->toDateString(),
                'to'=>Carbon::create('today')->toDateString()
            ]
        ];
        $filterCondition = $conditionDescriber->describeFilterCondition($searchDateRange);
        $visits =  Visit::filter($searchDateRange)->with('pet', 'user')
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('visit.index', compact('visits', 'filterCondition', 'searchDateRange'));
    }

    public function search(SearchRequest $request, FilterConditionDescriber $conditionDescriber)
    {
        $searchDateRange = $request->validated();
        $filterCondition = $conditionDescriber->describeFilterCondition($searchDateRange);
        $visits =  Visit::filter($searchDateRange)->with('pet', 'user')
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('visit.index', compact('visits', 'filterCondition', 'searchDateRange'));
    }

    public function create(CreateRequest $request)
    {
        $validatedRequest = $request->validated();
        try{
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            Visit::create($validatedRequest['visit']);
            Session::flash('success', "Прием успешно добавлен!");
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()
                ->route('pet.show', ['pet' => $validatedRequest['visit']['pet_id']])
                ->withErrors('Ошибка при создании према. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('pet.show', ['pet' => $validatedRequest['visit']['pet_id']]);
    }

    public function edit($id)
    {
        $visit = Visit::with('pet')->find($id);

        return view('visit.edit', compact('visit'));
    }

    public function update(EditRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try {
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            $visit = Visit::find($id);
            $visit->fill($validatedRequest['visit']);
            $visit->save()?
                Session::flash('success', "Прием успешно изменен!"):
                throw new \Exception('Ошибка при изменении према. Перезагрузите страницу и попробуйте снова.');
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()
                ->route('visit.edit', ['id'=>$id])
                ->withErrors($e->getMessage());
        }

        return redirect(route('visit.edit', ['id'=>$id]));
    }
}
