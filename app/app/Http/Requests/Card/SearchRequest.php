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
            'name' => [
                'alpha',
                'max:30',
                'nullable',
                'required_without_all:patronymic,lastName,phone,pets'
            ],
            'patronymic' => [
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:name,lastName,phone,pets'
            ],
            'lastName' => [
                'alpha',
                'max:30',
                'nullable',
                'required_without_all:name,patronymic,phone,pets'
            ],
            'phone' => [
                'starts_with:8',
                'digits_between:1,11',
                'nullable',
                'required_without_all:name,patronymic,lastName,pets'
            ],
            'pets' => [
                'alpha',
                'max:30',
                'nullable',
                'required_without_all:name,patronymic,lastName,phone'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required_without_all' => 'Хотя бы одно поле, должно быть заполнено.',
            'name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'name.max' => 'Привышен лимит символов в поле "Имя владельца"(30).',

            'patronymic.required_without_all' => 'Хотя бы одно поле, должно быть заполнено.',
            'patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(30).',

            'lastName.required_without_all' => 'Хотя бы одно поле, должно быть заполнено.',
            'lastName.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'lastName.max' => 'Привышен лимит символов в поле "Фамилия владельца"(30).',

            'phone.required_without_all' => 'Хотя бы одно поле, должно быть заполнено.',
            'phone.digits_between' => 'Поле "Телефон владельца" должно содержать только числа (Без пробелов и специальных символов), длина от 1 до 11.',
            'phone.starts_with' => 'Телефон должен начинаться с "8".',

            'pets.required_without_all'=>'Хотя бы одно поле, должно быть заполнено.',
            'pets.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pets.max'=>'Привышен лимит символов в поле "Кличка питомца"(30).',
        ];
    }

}
