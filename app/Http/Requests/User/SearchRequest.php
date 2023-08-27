<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
            "search" => [
                'sometimes',
                'required',
                'alpha',
                Rule::in(['active', 'inactive']),
            ]
        ];
    }

    public function messages()
    {
        return [
            'search.required' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
            'search.alpha' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
            'search.in' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
        ];
    }
}
