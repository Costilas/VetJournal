<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
                'min:6',
                'max:7',
            ],
            "user.name" => [
                'required',
                'alpha',
                'max:25',
            ],
            "user.patronymic" => [
                'required',
                'alpha',
                'max:25',
            ],
            "user.last_name" => [
                'required',
                'alpha',
                'max:25',
            ],
            "user.email" => [
                'required',
                'email',
                'unique:users,email',
            ],
            "user.password" => [
                'required',
                'string',
                'confirmed',
            ],
             "user.is_admin" => [
                'sometimes',
                 'digits:1',
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
            'user.name.max' =>'В поле "Имя" превышен лимит символов(25)',

            'user.patronymic.required' =>'Поле "Отчество" обязательно к заполнению.',
            'user.patronymic.alpha' =>'Поле "Отчество" имеет неверный формат(не должно содержать цифр и специальных символов)',
            'user.patronymic.max' =>'В поле "Отчество" превышен лимит символов(25)',

            'user.last_name.required' =>'Поле "Фамилия" обязательно к заполнению.',
            'user.last_name.alpha' =>'Поле "Фамилия" имеет неверный формат(не должно содержать цифр и специальных символов)',
            'user.last_name.max' =>'В поле "Фамилия" превышен лимит символов(25)',

            'user.email.required' => 'Поле "Email" обязательно к заполнению.',
            'user.email.email' => 'Поле "Email" должно соответствовать формату email@example.com',
            'user.email.unique' => 'Данные email адрес уже существует в базе данных. Проверьте правильность заполнения или укажите другой.',

            'user.password.required' => 'Поле "Пароль" обязательно к заполнению.',
            'user.password.string' => 'Поле "Пароль" имеет неверный формат.',
            'user.password.confirmed' => 'Поле "Пароль" не совпадает с введенным в поле "Подтвердите пароль".',

            'user.is_admin.sometimes' => 'Ошибка запроса. Обновите страницу и попробуйте снова.',
            'user.is_admin.digits' => 'Ошибка запроса. Обновите страницу и попробуйте снова',

        ];
    }
}
