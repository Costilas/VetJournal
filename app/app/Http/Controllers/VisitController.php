<?php

namespace App\Http\Controllers;

use App\Http\Requests\Visit\AddRequest;
use App\Http\Requests\Visit\EditRequest;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search'))
        {
            $rules = [
                "search.from" => [
                    'sometimes',
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d 00:00:01'),
                ],
                "search.to" => [
                    'sometimes',
                    'required',
                    'before_or_equal:'. now()->format('Y-m-d 23:59:59'),
                ],
            ];
            $rules['search'] = is_string($request->input('search'))?
                ['alpha', Rule::in(['today', 'week', 'yesterday']),]:
                ['required', 'array', 'min:2', 'max:2',];

            $validatedRequest = $request->validate($rules,
                [
                'search.required' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
                'search.alpha' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
                'search.in' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
                'search.min'=>'Некорректное количество данных для поиска приема по датам.',
                'search.max'=>'Некорректное количество данных для поиска приема по датам.',

                'search.from.required'=>'Поле "С:" должно быть заполнено.',
                'search.from.before_or_equal'=>'Дата в поле "С:" имеет некорректное значение',

                'search.to.required'=>'Поле "По:" должно быть заполнено.',
                'search.to.before_or_equal'=>'Дата в поле "По:" имеет некорректное значение',
            ]);
            $query = Visit::filter($validatedRequest);
        } else {
            $query = Visit::filter(['search'=>'today']);
        }
        $filterCondition = $validatedRequest['search']??null;
        $visits = $query->with('pet', 'user')
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('visit.index', compact('visits', 'filterCondition'));
    }

    public function create(AddRequest $request)
    {
        $validatedRequest = $request->validated();

        try{
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            Visit::create($validatedRequest['visit']);
            Session::flash('success', "Прием успешно добавлен!");
        }catch (\Exception $e){
            Log::debug($e);
            return redirect()
                ->route('pet.show', ['id' => $validatedRequest['visit']['pet_id']])
                ->withErrors('Ошибка при создании према. Перезагрузите страницу и попробуйте снова.');
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
        try {
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            $visit = Visit::find($id);
            $visit->fill($validatedRequest['visit']);
            $visit->save()?
                Session::flash('success', "Прием успешно изменен!"):
                throw new \Exception('Ошибка при изменении према. Перезагрузите страницу и попробуйте снова.');
        }catch (\Exception $e){
            Log::debug($e);
            return redirect()
                ->route('visit.edit', ['id'=>$id])
                ->withErrors($e);
        }

        return redirect(route('visit.edit', ['id'=>$id]));
    }
}
