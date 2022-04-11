<?php

namespace App\Http\Controllers;

use App\Http\Requests\Card\CreateRequest;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $owners = '';
        if (!empty($request->query())) {
            $validated = $request->validate([
                'name' => [
                    'alpha',
                    'max:25',
                    'nullable',
                    'required_without_all:patronymic,last_name,phone,pets'
                ],
                'patronymic' => [
                    'alpha',
                    'max:25',
                    'nullable',
                    'required_without_all:name,last_name,phone,pets'
                ],
                'last_name' => [
                    'alpha',
                    'max:25',
                    'nullable',
                    'required_without_all:name,patronymic,phone,pets'
                ],
                'phone' => [
                    'starts_with:8',
                    'digits_between:1,11',
                    'nullable',
                    'required_without_all:name,patronymic,last_name,pets'
                ],
                'pets' => [
                    'alpha',
                    'max:25',
                    'nullable',
                    'required_without_all:name,patronymic,last_name,phone'
                ]
            ]);
            $owners = Owner::filter($validated)->with('pets.kind')->paginate(10)->withQueryString();
        }

        return view('card.index', compact('owners'));
    }

    public function create(CreateRequest $request)
    {
        $validatedData = $request->validated();
        $newOwner = Owner::create($validatedData['owner']);
        $newPet = $newOwner->pets()->create($validatedData['pet']);

        if (!$newOwner->id && !$newPet->id) {
            return redirect()->back()
                ->withInput()
                ->withErrors('При добавлении что-то пошло не так. Перезагрузите страницу и попробуйте снова.');
        } else {
            Session::flash('success', "Новая карточка успешно создана!");
        }

        return redirect()->route('owner.show', ['id' => $newOwner->id]);
    }
}
