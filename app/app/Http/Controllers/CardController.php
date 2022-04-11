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
            ], [
                'name.required_without_all' => 'Необходио заполнить поле "Имя владельца".',
                'name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
                'name.max' => 'Привышен лимит символов в поле "Имя владельца"(25).',

                'patronymic.required_without_all' => 'Необходио заполнить поле "Отчество владельца".',
                'patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
                'patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(25).',

                'last_name.required_without_all' => 'Необходио заполнить поле "Фамилия владельца".',
                'last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
                'last_name.max' => 'Привышен лимит символов в поле "Фамилия владельца"(25).',

                'phone.required_without_all' => 'Необходио заполнить поле "Телефон владельца".',
                'phone.digits_between' => 'Поле "Телефон владельца" должно содержать только числа (Без пробелов и специальных символов), длина от 1 до 11.',
                'phone.starts_with' => 'Телефон должен начинаться с "8".',

                'pets.required_without_all'=>'Необходимо заполнить поле "Кличка питомца".',
                'pets.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
                'pets.max'=>'Привышен лимит символов в поле "Кличка питомца"(25).',
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
