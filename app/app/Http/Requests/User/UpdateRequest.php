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
            "user.is_admin" => [
                'sometimes',
                'digits:1',
            ],
        ];
    }
}
