<?php

namespace App\Http\Requests\Pet;

use Illuminate\Foundation\Http\FormRequest;

class SearchPetVisitsRequest extends FormRequest
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
                'max:2'
            ],
            "search.from" => [
                'required',
                'before_or_equal:' . now()->format('Y-m-d'),
            ],
            "search.to" => [
                'required',
                'before_or_equal:' . now()->format('Y-m-d'),
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
            'search.min' => 'Все поля данных поиска приема должны быть заполнены.',
            'search.max' => ' Обнаружены лишние поля.',
            'search.array' => 'Проверьте заполненность всех полей поиска приема.',
            'search.required' => 'Все поля формы поиска приема должны быть заполнены.',

            'search.from.required' => 'Необходимо заполнить поле "С:".',
            'search.from.before_or_equal' => 'Неверный формат даты в поле "С:" дата не может быть больше текущей.',

            'search.to.required' => 'Необходимо заполнить поле "По:".',
            'search.to.before_or_equal' => 'Неверный формат даты в поле "По:" дата не может быть больше текущей.',
        ];
    }
}
