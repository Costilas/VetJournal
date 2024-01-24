<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class SearchVisitsRequest extends FormRequest
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
                'required',
                'array',
                'min:2',
                'max:2',
            ],
            "search.from" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d'),
            ],
            "search.to" => [
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
            'search.required' => 'Ошибка фильтрации. Обновите страницу и попробуйте снова.',
            'search.min'=>'Некорректное количество данных для поиска приема по датам.',
            'search.max'=>'Некорректное количество данных для поиска приема по датам.',

            'search.from.required'=>'Поле "С:" должно быть заполнено.',
            'search.from.before_or_equal'=>'Дата в поле "С:" имеет некорректное значение. Дата не может быть больше текущей.',

            'search.to.required'=>'Поле "По:" должно быть заполнено.',
            'search.to.before_or_equal'=>'Дата в поле "По:" имеет некорректное значение. Дата не может быть больше текущей.',
        ];
    }
}
