<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
                'min:7',
                'max:7'
            ],
            "visit.weight" => [
                'required',
                'string',
                'not_regex:/^0{1,2}[\.\,]0+$/i',
                'regex:/^(\d{1,2}[\.\,]\d{1,3})$|^(\d{1,2})$/i',
            ],
            "visit.temperature" => [
                'required',
                'string',
                'not_regex:/^0\d{1}[\.\,]0+$|^\d{1,2}[\,\.]0+$/i',
                'regex:/^(\d{1,2}[\.\,]\d{1})$|^(\d{1,2})$/i',
            ],
            "visit.pre_diagnosis" => [
                'required',
                'string',
                'max:60'
            ],
            "visit.visit_info" => [
                'required',
                'string',
                'max:1000'
            ],
            "visit.visit_date" => [
                'required',
                'before_or_equal:'. now()->format('Y-m-d H:i:s'),
            ],
            "visit.pet_id" => [
                'required',
                'numeric'
            ],
            "visit.user_id" => [
                'required',
                'numeric',
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
            'visit.min' => 'Все поля данных приема должны быть заполнены.',
            'visit.max' => 'Все поля данных приема должны быть заполнены.',
            'visit.array' => 'Проверьте заполненность всех полей приема.',
            'visit.required' => 'Все поля формы добавления приема должны быть заполнены.',

            'visit.weight.required'=>'Необходимо заполнить поле "Вес".',
            'visit.weight.digitsBetween'=>'Поле "Вес" должно содержать только от одного до трех чисел.',
            'visit.weight.not_regex'=>'Формат поля "Вес" имеет неверный формат (Пример: 1,075; 10,5; 1,5; 1.075; 10.5; 1.5 разделитель либо точка, либо запятая)',
            'visit.weight.regex'=>'Формат поля "Вес" имеет неверный формат (Пример: 1,075; 10,5; 1,5; 1.075; 10.5; 1.5 разделитель либо точка, либо запятая)',

            'visit.temperature.required'=>'Необходимо заполнить поле "Температура".',
            'visit.temperature.digit'=>'Поле "Температура" должно содержать только от одного до двух чисел.',
            'visit.temperature.not_regex'=>'Формат поля "Температура" имеет неверный формат (Пример: 10,5; 1,5; 10.5; 1.5 разделитель либо точка, либо запятая)',
            'visit.temperature.regex'=>'Формат поля "Температура" имеет неверный формат (Пример: 10,5; 1,5; 36.5; 1.5 разделитель либо точка, либо запятая)',

            'visit.pre_diagnosis.required'=>'Необходимо заполнить поле "Предварительный диагноз".',
            'visit.pre_diagnosis.string'=>'Неверные данные в поле "Предварительный диагноз".',
            'visit.pre_diagnosis.max'=>'Превышен лимит символов в поле "Предварительный диагноз"(60).',

            'visit.visit_info.required'=>'Необходимо заполнить поле "Информация приема".',
            'visit.visit_info.string'=>'Неверный формат поля "Информация приема".',
            'visit.visit_info.max'=>'Превышен лимит символов в поле "Информация приема"(1000).',

            'visit.visit_date.required' => 'Информация о дате приема заполняется автоматически, но что-то пошло не так.',
            'visit.visit_date.before_or_equal' => 'Неверный формат даты приема.',

            'visit.pet_id.required' => 'Если вы играетесь с этим полем, то не стоит, верните как было (Required) :)',
            'visit.pet_id.numeric' => 'Если вы играетесь с этим полем, то не стоит, верните как было (Numbers) :)',

            'visit.doctor_id.required' => 'Поле "Кем был проведен прием" является обязательным к заполнению.',
            'visit.doctor_id.numeric' => 'Поле "Кем был проведен прием" должно содержать только числовое значение.',
        ];
    }
}
