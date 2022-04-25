<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            "name" => [
                'required',
                'alpha',
                'max:20',
            ],
            "patronymic" => [
                'required',
                'alpha',
                'max:20',
            ],
            "last_name" => [
                'required',
                'alpha',
                'max:20',
            ],
            "phone" => [
                'required',
                'digits:11',
                'starts_with:8'
            ],
            "address" => [
                'required',
                'string',
                'max:60',
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Необходио заполнить поле "Имя владельца".',
            'name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'name.max' => 'Привышен лимит символов в поле "Имя владельца"(20).',

            'patronymic.required' => 'Необходио заполнить поле "Отчество владельца".',
            'patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(20).',

            'last_name.required' => 'Необходио заполнить поле "Фамилия владельца".',
            'last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'last_name.max' => 'Привышен лимит символов в поле "Фамилия владельца"(20).',

            'phone.required' => 'Необходио заполнить поле "Телефон владельца".',
            'phone.digits' => 'Поле "Телефон владельца" должно содержать 11 чисел(Без пробелов и специальных символов).',
            'phone.max' => 'Привышен лимит символов в поле "Телефон владельца"(11).',
            'phone.starts_with' => 'Телефон должен начинаться с "8".',

            'address.required' => 'Необходио заполнить поле "Адрес владельца".',
            'address.string' => 'Поле "Адрес владельца" имеет неверный формат.',
            'address.max' => 'Привышен лимит символов в поле "Адрес владельца"(60)',
        ];
    }
}
