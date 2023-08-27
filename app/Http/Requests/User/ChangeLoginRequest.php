<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangeLoginRequest extends FormRequest
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
            "user.email" => [
                'required',
                'email',
                'unique:users,email',
                'max:50'
            ],
        ];
    }

    public function messages()
    {
        return [
            'user.email.required' => 'Поле "Email" обязательно к заполнению.',
            'user.email.email' => 'Поле "Email" должно соответствовать формату email@example.com',
            'user.email.unique' => 'Данный email адрес уже существует в базе данных. Проверьте правильность заполнения или укажите другой.',
            'user.email.max' =>'В поле "Email" превышен лимит символов(50)',
        ];
    }
}
