<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
                'string',
                'confirmed',
            ],
        ];
    }

    public function messages()
    {
        return [
            'visit.password.required' => 'Поле "Пароль" является обязательным.',
            'visit.password.string' => 'Поле "Пароль" имеет неверный формат.',
            'visit.password.confirmed' => 'Поле "Пароль" не совпадает с введенным в поле "Подтвердите пароль".',
        ];
    }
}
