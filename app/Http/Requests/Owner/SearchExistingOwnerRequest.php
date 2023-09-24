<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class SearchExistingOwnerRequest extends FormRequest
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
                'required_without_all:patronymic,lastName,phone,pets,additionalPhone,email'
            ],
            'patronymic' => [
                'alpha',
                'max:25',
                'nullable',
                'required_without_all:name,lastName,phone,pets,additionalPhone,email'
            ],
            'lastName' => [
                'alpha',
                'max:30',
                'nullable',
                'required_without_all:name,patronymic,phone,pets,additionalPhone,email'
            ],
            'phone' => [
                'starts_with:8',
                'digits_between:1,11',
                'nullable',
                'required_without_all:name,patronymic,lastName,pets,additionalPhone,email'
            ],
            'additionalPhone' => [
                'digits_between:1,20',
                'nullable',
                'required_without_all:name,patronymic,lastName,phone,pets,email'
            ],
            'email' => [
                'string',
                'max:50',
                'nullable',
                'required_without_all:name,patronymic,lastName,phone,pets,additionalPhone'
            ],
            'pets' => [
                'alpha',
                'max:30',
                'nullable',
                'required_without_all:name,patronymic,lastName,phone,additionalPhone,email'
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

            'additionalPhone.required_without_all' => 'Хотя бы одно поле, должно быть заполнено.',
            'additionalPhone.digits_between' => 'Поле "Доп. телефон владельца" должно содержать только числа (Без пробелов и специальных символов), длина от 5 до 20.',

            'email.required_without_all'=>'Хотя бы одно поле, должно быть заполнено.',
            'email.string'=>'Поле "Электронная почта владельца" имеет неверный формат.',
            'email.max'=>'Привышен лимит символов в поле "Электронная почта владельца"(50).',

            'pets.required_without_all'=>'Хотя бы одно поле, должно быть заполнено.',
            'pets.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pets.max'=>'Привышен лимит символов в поле "Кличка питомца"(30).',
        ];
    }
}
