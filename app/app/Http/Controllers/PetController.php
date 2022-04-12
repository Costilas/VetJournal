<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pet\AddRequest;
use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PetController extends Controller
{
    public function show($id, Request $request)
    {
        $pet = Pet::with('owner.pets', 'gender', 'kind')->findOrFail($id);
        if (!empty($request) && $request->has('visits')) {
            $validatedRequest = $request->validate([
                "visits" => [
                    'required',
                    'array',
                    'min:2',
                    'max:2'
                ],
                "visits.from" => [
                    'required',
                    'before_or_equal:' . now()->format('Y-m-d'),
                ],
                "visits.to" => [
                    'required',
                    'before_or_equal:' . now()->format('Y-m-d'),
                ],
            ], [
                'visits.min' => 'Все поля данных поиска приема должны быть заполнены.',
                'visits.array' => 'Проверьте заполненность всех полей поиска приема.',
                'visits.required' => 'Все поля формы поиска приема должны быть заполнены.',
                'visits.max'=>' Обнаружены лишние поля.',

                'visits.from.required'=>'Необходимо заполнить поле "С:".',
                'visits.from.before_or_equals'=>'Неверный формат даты в поле "С:".',

                'visits.to.required'=>'Необходимо заполнить поле "По:".',
                'visits.to.before_or_equals:'=>'Неверный формат даты в поле "По:".',
            ]);
            $validatedRequest['pet_id'] = $id;
            $query = Visit::filter($validatedRequest);
        } else {
            $query = Visit::where('pet_id', '=', $id);
        }
            $visits = $query->with('user')->orderBy('visit_date', 'DESC')->paginate(5)->withQueryString();

        return view('pet.show', compact('pet', 'visits'));
    }

    public function add(AddRequest $request)
    {
        $validatedRequest = $request->validated();
        try{
            $newPet = Pet::create($validatedRequest['pet']);
            Session::flash('success', "Питомец $newPet->name успешно добавлен.");
        }catch (\Exception $e) {
            Log::debug($e);
            return redirect()->route('owner.show', ['id' => $validatedRequest['pet']['owner_id']])
                ->withErrors('error', 'Питомец не был добавлен. Проверьте введенные данные.');
        }

        return redirect()->route('owner.show', ['id' => $validatedRequest['pet']['owner_id']]);
    }
}
