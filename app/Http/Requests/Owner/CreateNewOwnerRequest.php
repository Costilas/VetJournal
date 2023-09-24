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
                'required_without:owner.additional_phone',
                'digits:11',
                'nullable',
                'unique:owners,phone',
                'starts_with:8'
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

            'owner.name.required' => 'Необходио заполнить поле "Имя владельца".',
            'owner.name.alpha' => 'Поле "Имя владельца" не должно содержать числа и специальные символы.',
            'owner.name.max' => 'Привышен лимит символов в поле "Имя владельца"(30).',

            'owner.patronymic.required' => 'Необходио заполнить поле "Отчество владельца".',
            'owner.patronymic.alpha' => 'Поле "Отчество владельца" не должно содержать числа и специальные символы.',
            'owner.patronymic.max' => 'Привышен лимит символов в поле "Отчество владельца"(30).',

            'owner.last_name.required' => 'Необходио заполнить поле "Фамилия владельца".',
            'owner.last_name.alpha' => 'Поле "Фамилия владельца" не должно содержать числа и специальные символы.',
            'owner.last_name.max' => 'Привышен лимит символов в поле "Фамилия владельца"(30).',

            'owner.phone.required_without' => 'Поле "Телефон владельца" должно быть заполнено если Вы не указали дополнительный номер телефона.',
            'owner.phone.digits' => 'Поле "Телефон владельца" должно содержать 11 чисел(Без пробелов и специальных символов).',
            'owner.phone.max' => 'Привышен лимит символов в поле "Телефон владельца"(11).',
            'owner.phone.unique' => "  Данные введенные в поле 'Телефон владельца' уже найдены в списке зарегистрированных пользователей.
                                       Проверьте правильность заполнения поля или проверьте телефон в поиске по существующим.",
            'owner.phone.starts_with' => 'Телефон должен начинаться с "8".',

            'owner.additional_phone.required_without' => 'Поле "Дополнительный телефон" должно быть заполнено если Вы не указали основной номер телефона.',
            'owner.additional_phone.digits_between' => 'В поле "Дополнительный телефон" должно содержать только числа (Без пробелов и специальных символов) (от 5 до 20 символов).',

            'owner.email.email' => 'Поле "Адрес электронной почты" имеет неверный формат (Пример: hello@example.com).',
            'owner.email.max' => 'В "Адрес электронной почты" превышен лимит символов (макс. 50).',

            'owner.address.required' => 'Необходио заполнить поле "Адрес владельца".',
            'owner.address.string' => 'Поле "Адрес владельца" имеет неверный формат',
            'owner.address.max' => 'Привышен лимит символов в поле "Адрес владельца"(255)',

            'pet.pet_name.required'=>'Необходимо заполнить поле "Кличка питомца".',
            'pet.pet_name.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pet.pet_name.max'=>'Привышен лимит символов в поле "Кличка питомца"(30).',

            'pet.kind_id.required'=>'Необходимо заполнить поле "Вид питомца".',
            'pet.kind_id.digit'=>'Неверные данные в поле "Вид питомца".',
            'pet.kind_id.exists'=>'Несуществующий id в поле "Вид питомца".',

            'pet.gender_id.required'=>'Необходимо заполнить поле "Пол питомца".',
            'pet.gender_id.digit'=>'Неверные данные в поле "Пол питомца".',
            'pet.gender_id.exists'=>'Несуществующий id в поле "Пол питомца".',

            'pet.castration_condition_id.required'=>'Необходимо заполнить поле "Кастрация питомца".',
            'pet.castration_condition_id.digit'=>'Неверные данные в поле "Кастрация питомца".',
            'pet.castration_condition_id.exists'=>'Несуществующий id в поле "Кастрация питомца".',

            'pet.birth.required'=>'Необходимо заполнить поле "Дата рождения питомца".',
            'pet.birth.before_or_equal'=>'Неверный формат поля "Дата рождения питомца". Дата не может быть больше чем текущая.',
        ];
    }
}
