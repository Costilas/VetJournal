<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pet\AddRequest;
use App\Http\Requests\Pet\EditRequest;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PetController extends Controller
{
    public function show($id, Request $request)
    {
        if ($request->has('search')) {
            $validatedRequest = $request->validate([
                "search" => [
                    'required',
                    'array',
                    'min:2',
                    'max:2'
                ],
                "search.from" => [
                    'required',
                    'before_or_equal:' . now()->format('Y-m-d'),
                ],
                "search.to" => [
                    'required',
                    'before_or_equal:' . now()->format('Y-m-d'),
                ],
            ], [
                'search.min' => 'Все поля данных поиска приема должны быть заполнены.',
                'search.array' => 'Проверьте заполненность всех полей поиска приема.',
                'search.required' => 'Все поля формы поиска приема должны быть заполнены.',
                'search.max'=>' Обнаружены лишние поля.',

                'search.from.required'=>'Необходимо заполнить поле "С:".',
                'search.from.before_or_equals'=>'Неверный формат даты в поле "С:".',

                'search.to.required'=>'Необходимо заполнить поле "По:".',
                'search.to.before_or_equals:'=>'Неверный формат даты в поле "По:".',
            ]);
        }
        $validatedRequest['pet_id'] = $id;

        $pet = Pet::with('gender', 'kind')
            ->findOrFail($id);
        $owner = Owner::find($pet->owner_id);
        $visits = Visit::filter($validatedRequest)
            ->with('user')
            ->orderBy('visit_date', 'DESC')
            ->paginate(5)
            ->withQueryString();

        return view('pet.show', compact('pet', 'visits', 'owner', 'validatedRequest'));
    }

    public function add(AddRequest $request)
    {
        $validatedRequest = $request->validated();
        try{
            $newPet = Pet::create($validatedRequest['pet']);
            Session::flash('success', "Питомец $newPet->name успешно добавлен.");
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('owner.show', ['id' => $validatedRequest['pet']['owner_id']])
                ->withErrors('error', 'Питомец не был добавлен. Проверьте введенные данные.');
        }

        return redirect()->route('owner.show', ['id' => $validatedRequest['pet']['owner_id']]);
    }

    public function edit($id)
    {
        $pet = Pet::with('kind', 'gender')->find($id);

        return view('pet.edit', compact('pet'));
    }

    public function update(EditRequest $request, $id)
    {
        $validatedRequest = $request->validated();
        try{
            $owner = Pet::findOrFail($id);
            $owner->fill($validatedRequest['pet']);
            $owner->save()?
                Session::flash('success', "Питомец успешно отредактирован!"):
                throw new \Exception('Ошибка при редактирования питомца. Перезагрузите страницу и попробуйте снова.');
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('pet.edit', ['id' => $id])
                ->withErrors($e->getMessage());
        }

        return redirect()->route('pet.edit', ['id' => $id]);

    }
}
