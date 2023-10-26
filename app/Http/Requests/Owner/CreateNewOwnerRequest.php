<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewOwnerRequest extends FormRequest
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
                'max:30',
            ],
            "owner.patronymic" => [
                'required',
                'alpha',
                'max:30',
            ],
            "owner.last_name" => [
                'required',
                'alpha',
                'max:30',
            ],
            "owner.address" => [
                'required',
                'string',
                'max:255',
            ],
            "owner.phone" => [
                'phone:' . config('global.clinic_country'),
                'required_without:owner.additional_phone',
                'nullable',
            ],
            "owner.additional_phone" => [
                'required_without:owner.phone',
                'digits_between:5,20',
                'nullable',
            ],
            "owner.email" => [
                'email',
                'nullable',
                'max:50'
            ],
            "pets" => [
                'required',
                'array',
                'min:1',
            ],
            "pets.*.pet_name" => [
                'required',
                'alpha',
                'max:20'
            ],
            "pets.*.kind_id" => [
                'required',
                'digits:1',
                'exists:kinds,id'
            ],
            "pets.*.gender_id" => [
                'required',
                'digits:1',
                'exists:genders,id'
            ],
            "pets.*.castration_condition_id" => [
                'required',
                'digits:1',
                'exists:castration_conditions,id'
            ],
            "pets.*.birth" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d'),
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

            'pet.min' => 'Все поля данных питомца должны быть заполнены.',
            'pet.array' => 'Проверьте заполненность всех полей питомца',

            'owner.name.required' => 'Необходимо заполнить поле "Имя владельца".',
            'owner.name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'owner.name.max' => 'Превышен лимит символов в поле "Имя владельца"(30).',

            'owner.patronymic.required' => 'Необходимо заполнить поле "Отчество владельца".',
            'owner.patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'owner.patronymic.max' => 'Превышен лимит символов в поле "Отчество владельца"(30).',

            'owner.last_name.required' => 'Необходио заполнить поле "Фамилия владельца".',
            'owner.last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'owner.last_name.max' => 'Превышен лимит символов в поле "Фамилия владельца"(30).',

            'phone' => 'Формат указанного телефона не совпадает со внутренним форматом телефонных номеров страны - ' . config('global.clinic_country'),

            'owner.additional_phone.required_without' => 'Поле "Дополнительный телефон" должно быть заполнено если Вы не указали основной номер телефона.',
            'owner.additional_phone.digits_between' => 'В поле "Дополнительный телефон" должно содержать только числа (Без пробелов и специальных символов) (от 5 до 20 символов).',

            'owner.email.email' => 'Поле "Адрес электронной почты" имеет неверный формат (Пример: hello@example.com).',
            'owner.email.max' => 'В "Адрес электронной почты" превышен лимит символов (макс. 50).',

            'owner.address.required' => 'Необходимо заполнить поле "Адрес владельца".',
            'owner.address.string' => 'Поле "Адрес владельца" имеет неверный формат',
            'owner.address.max' => 'Превышен лимит символов в поле "Адрес владельца"(255)',

            'pets.*.pet_name.required'=>'Необходимо заполнить поле "Кличка питомца".',
            'pets.*.pet_name.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pets.*.pet_name.max'=>'Превышен лимит символов в поле "Кличка питомца"(30).',

            'pets.*.kind_id.required'=>'Необходимо заполнить поле "Вид питомца".',
            'pets.*.kind_id.digit'=>'Неверные данные в поле "Вид питомца".',
            'pets.*.kind_id.exists'=>'Несуществующий id в поле "Вид питомца".',

            'pets.*.gender_id.required'=>'Необходимо заполнить поле "Пол питомца".',
            'pets.*.gender_id.digit'=>'Неверные данные в поле "Пол питомца".',
            'pets.*.gender_id.exists'=>'Несуществующий id в поле "Пол питомца".',

            'pets.*.castration_condition_id.required'=>'Необходимо заполнить поле "Кастрация питомца".',
            'pets.*.castration_condition_id.digit'=>'Неверные данные в поле "Кастрация питомца".',
            'pets.*.castration_condition_id.exists'=>'Несуществующий id в поле "Кастрация питомца".',

            'pets.*.birth.required'=>'Необходимо заполнить поле "Дата рождения питомца".',
            'pets.*.birth.before_or_equal'=>'Неверный формат поля "Дата рождения питомца". Дата не может быть больше чем текущая.',
        ];
    }
}
