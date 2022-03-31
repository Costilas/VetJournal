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
            "visit" => [
                'required',
                'array',
                'min:3',
                'max:3'
            ],
            "visit.date_start" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d'),
            ],
            "visit.date_end" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d'),
            ],
            "visit.pet_id" => [
                'required',
                'numeric'
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
            'visit.min' => 'Все поля данных поиска приема должны быть заполнены.',
            'visit.array' => 'Проверьте заполненность всех полей поиска приема.',
            'visit.required' => 'Все поля формы поиска приема должны быть заполнены.',
            'visit.max'=>' Обнаружены лишние поля.',

            'visit.start_date.required'=>'Необходимо заполнить поле "С:".',
            'visit.start_date.before_or_equals'=>'Неверный формат даты в поле "С:".',

            'visit.end_date.required'=>'Необходимо заполнить поле "По:".',
            'visit.end_date.before_or_equals:'=>'Неверный формат даты в поле "По:".',

            'visit.pet_id.required'=>'Нет необходимости редактировать в ручную скрытые поля(Required).',
            'visit.pet_id.numeric'=>'Нет необходимости редактировать в ручную скрытые поля(Numeric).',
        ];
    }
}
