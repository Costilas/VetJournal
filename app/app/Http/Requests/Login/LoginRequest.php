<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

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
            "user.password" => [
                'required',
                'alpha_num',
            ],
            "user.email" => [
                'required',
                'email',
            ],
        ];
    }

    public function messages()
    {
        return [
            'user.password.required' => 'Поле "Пароль" обязательно должно быть заполнено.',
            'user.password.alpha_num' => 'Поле "Пароль" не должно содержать специальных символов.',

            'user.email.required' => 'Поле "Email"',
            'user.email.email' => 'Поле "Email" должно соответствовать формату email@example.com',
        ];
    }
}
