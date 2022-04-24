<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
            "password" => [
                'required',
                'string',
            ],
            "email" => [
                'required',
                'email',
            ],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Поле "Пароль" обязательно должно быть заполнено.',
            'password.string' => 'Поле "Пароль" имеет неверный формат.',
            'password.password' => 'Поле "Пароль" тест.',

            'email.required' => 'Поле "Email"',
            'email.email' => 'Поле "Email" должно соответствовать формату email@example.com',
        ];
    }
}
