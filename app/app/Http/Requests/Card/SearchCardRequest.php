<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class SearchCardRequest extends FormRequest
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
            'name'=>'string|max:25|nullable|required_without_all:patronymic,last_name,phone,pet_name',
            'patronymic'=>'string|max:25|nullable|required_without_all:name,last_name,phone,pet_name',
            'last_name'=>'string|max:25|nullable|required_without_all:name, patronymic,phone,pet_name',
            'phone'=>'starts_with:8|digits_between:1,11|nullable|required_without_all:name,patronymic,last_name,pet_name',
            'pet_name'=>'string|max:25|nullable|required_without_all:name,patronymic,last_name,phone',
        ];
    }

    public function messages()
    {
        return [
            'owner.min' => 'Все поля данных владельца должны быть заполнены.',
            'owner.array' => 'Проверьте заполненность всех полей владельца',

            'pet.min' => 'Все поля данных питомца должны быть заполнены.',
            'pet.array' => 'Проверьте заполненность всех полей питомца',

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
            'owner.phone.unique' => "  Данные введенные в поле 'Телефон владельца' уже найдены в списке зарегистрированных пользователей.
                                       Проверьте правильность заполнения поля или проерьте телефон в поиске по существующим.",
            'owner.phone.starts_with' => 'Телефон должен начинаться с "8".',

            'owner.address.required' => 'Необходио заполнить поле "Адрес владельца".',
            'owner.address.string' => 'Поле "Адрес владельца" не должно содержать числа и специальные символы.',
            'owner.address.max' => 'Привышен лимит символов в поле "Фамилия владельца"(60)',

            'pet.pet_name.required'=>'Необходимо заполнить поле "Кличка питомца".',
            'pet.pet_name.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pet.pet_name.max'=>'Привышен лимит символов в поле "Кличка питомца"(20).',

            'pet.kind_id.required'=>'Необходимо заполнить поле "Вид питомца".',
            'pet.kind_id.digit'=>'Неверные данные в поле "Вид питомца".',

            'pet.gender_id.required'=>'Необходимо заполнить поле "Пол питомца".',
            'pet.gender_id.digit'=>'Неверные данные в поле "Пол питомца".',

            'pet.birth.required'=>'Необходимо заполнить поле "Дата рождения питомца".',
            'pet.birth.date'=>'Неверный формат поля "Дата рождения питомца".',
        ];
    }

}
