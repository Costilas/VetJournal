<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "user" => [
                'required',
                'array',
                'min:3',
                'max:3',
            ],
            "user.name" => [
                'required',
                'alpha',
                'max:30',
            ],
            "user.patronymic" => [
                'required',
                'alpha',
                'max:30',
            ],
            "user.last_name" => [
                'required',
                'alpha',
                'max:30',
            ],
        ];
    }

    public function messages()
    {
        return [
            'user.min' => 'Все поля данных приема должны быть заполнены.',
            'user.max' => 'Все поля данных приема должны быть заполнены.',
            'user.array' => 'Проверьте заполненность всех полей приема.',
            'user.required' => 'Все поля формы добавления приема должны быть заполнены.',

            'user.name.required' =>'Поле "Имя" обязательно к заполнению.',
            'user.name.alpha' =>'Поле "Имя" имеет неверный формат(не должно содержать цифр и специальных символов)',
            'user.name.max' =>'В поле "Имя" превышен лимит символов(30)',

            'user.patronymic.required' =>'Поле "Отчество" обязательно к заполнению.',
            'user.patronymic.alpha' =>'Поле "Отчество" имеет неверный формат(не должно содержать цифр и специальных символов)',
            'user.patronymic.max' =>'В поле "Отчество" превышен лимит символов(30)',

            'user.last_name.required' =>'Поле "Фамилия" обязательно к заполнению.',
            'user.last_name.alpha' =>'Поле "Фамилия" имеет неверный формат(не должно содержать цифр и специальных символов)',
            'user.last_name.max' =>'В поле "Фамилия" превышен лимит символов(30)',
        ];
    }
}
