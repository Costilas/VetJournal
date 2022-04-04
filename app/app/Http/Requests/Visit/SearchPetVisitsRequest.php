<?php

namespace App\Http\Requests\Visit;

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
            "visits" => [
                'required',
                'array',
                'min:2',
                'max:2'
            ],
            "visits.from" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d'),
            ],
            "visits.to" => [
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
            'visits.min' => 'Все поля данных поиска приема должны быть заполнены.',
            'visits.array' => 'Проверьте заполненность всех полей поиска приема.',
            'visits.required' => 'Все поля формы поиска приема должны быть заполнены.',
            'visits.max'=>' Обнаружены лишние поля.',

            'visits.from.required'=>'Необходимо заполнить поле "С:".',
            'visits.from.before_or_equals'=>'Неверный формат даты в поле "С:".',

            'visits.to.required'=>'Необходимо заполнить поле "По:".',
            'visits.to.before_or_equals:'=>'Неверный формат даты в поле "По:".',
        ];
    }
}
