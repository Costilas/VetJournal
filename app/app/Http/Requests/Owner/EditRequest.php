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
            "owner" => [
                'required',
                'array',
                'min:5'
            ],
            "owner.name" => [
                'required',
                'alpha',
                'max:20',
            ],
            "owner.patronymic" => [
                'required',
                'alpha',
                'max:20',
            ],
            "owner.last_name" => [
                'required',
                'alpha',
                'max:20',
            ],
            "owner.phone" => [
                'required',
                'digits:11',
                'starts_with:8'
            ],
            "owner.address" => [
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
            'owner.min' => 'Все поля данных владельца должны быть заполнены.',
            'owner.array' => 'Проверьте заполненность всех полей владельца',

            'owner.name.required' => 'Необходио заполнить поле "Имя владельца".',
            'owner.name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'owner.name.max' => 'Привышен лимит символов в поле "Имя владельца"(20).',

            'owner.patronymic.required' => 'Необходио заполнить поле "Отчество владельца".',
            'owner.patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'owner.patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(20).',

            'owner.last_name.required' => 'Необходио заполнить поле "Фамилия владельца".',
            'owner.last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'owner.last_name.max' => 'Привышен лимит символов в поле "Фамилия владельца"(20).',

            'owner.phone.required' => 'Необходио заполнить поле "Телефон владельца".',
            'owner.phone.digits' => 'Поле "Телефон владельца" должно содержать только числа (Без пробелов и специальных символов).',
            'owner.phone.max' => 'Привышен лимит символов в поле "Телефон владельца"(11).',
            'owner.phone.starts_with' => 'Телефон должен начинаться с "8".',

            'owner.address.required' => 'Необходио заполнить поле "Адрес владельца".',
            'owner.address.string' => 'Поле "Адрес владельца" не должно содержать числа и специальные символы.',
            'owner.address.max' => 'Привышен лимит символов в поле "Фамилия владельца"(60)',
        ];
    }
}
