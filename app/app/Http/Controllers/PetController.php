<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pet\AddRequest;
use App\Http\Requests\Pet\EditRequest;
use App\Http\Requests\Pet\SearchRequest;
use App\Models\Pet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PetController extends Controller
{
    public function show(Pet $pet)
    {
        $pet->load('gender', 'kind', 'owner');
        $owner = $pet->owner;
        $visits = $pet->visits()
            ->with('user')
            ->latest('visit_date')
            ->paginate(5)
            ->withQueryString();

        return view('pet.show', compact('pet', 'visits', 'owner'));
    }

    public function search(SearchRequest $request, Pet $pet)
    {
        $validatedData = $request->validated();
        $pet->load('gender', 'kind', 'owner');
        $owner = $pet->owner;
        $visits = $pet->visits()
            ->filter($validatedData)
            ->with('user')
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('pet.show', compact('pet','visits', 'owner' ));
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
                ->withErrors('Питомец не был добавлен. Проверьте введенные данные.');
        }

        return redirect()->route('owner.show', ['id' => $validatedRequest['pet']['owner_id']]);
    }

    public function edit(Pet $pet)
    {
        $pet->load('kind', 'gender');

        return view('pet.edit', compact('pet'));
    }

    public function update(EditRequest $request, Pet $pet)
    {
        $validatedRequest = $request->validated();
        try{
            $pet->fill($validatedRequest['pet'])?->save()
                ? Session::flash('success', "Питомец успешно отредактирован!")
                : throw new \Exception();
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('pet.edit', ['pet' => $pet])
                ->withErrors('Ошибка при редактирования питомца. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('pet.edit', ['pet' => $pet]);

    }
}
