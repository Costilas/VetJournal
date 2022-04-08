<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>[
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:patronymic,last_name,phone,pets'
            ],
            'patronymic'=>[
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:name,last_name,phone,pets'
            ],
            'last_name'=>[
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:name,patronymic,phone,pets'
            ],
            'phone'=>[
                'starts_with:8',
                'digits_between:1,11',
                'nullable',
                'required_without_all:name,patronymic,last_name,pets'
            ],

            'pets'=>[
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:name,patronymic,last_name,phone'
            ]
        ];
    }

    public function messages()
    {
        return [

            'name.required_without_all' => 'Необходио заполнить поле "Имя владельца".',
            'name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'name.max' => 'Привышен лимит символов в поле "Имя владельца"(20).',

            'patronymic.required_without_all' => 'Необходио заполнить поле "Отчество владельца".',
            'patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(20).',

            'last_name.required_without_all' => 'Необходио заполнить поле "Фамилия владельца".',
            'last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'last_name.max' => 'Привышен лимит символов в поле "Фамилия владельца"(20).',

            'phone.required_without_all' => 'Необходио заполнить поле "Телефон владельца".',
            'phone.digits' => 'Поле "Телефон владельца" должно содержать только числа (Без пробелов и специальных символов).',
            'phone.max' => 'Привышен лимит символов в поле "Телефон владельца"(11).',
            'phone.unique' => "  Данные введенные в поле 'Телефон владельца' уже найдены в списке зарегистрированных пользователей.
                                       Проверьте правильность заполнения поля или проерьте телефон в поиске по существующим.",
            'phone.starts_with' => 'Телефон должен начинаться с "8".',

            'pets.required_without_all'=>'Необходимо заполнить поле "Кличка питомца".',
            'pets.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pets.max'=>'Привышен лимит символов в поле "Кличка питомца"(20).',

        ];
    }

}
