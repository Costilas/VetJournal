<?php

namespace App\Http\Requests\Visit;

use Illuminate\Foundation\Http\FormRequest;

class EditVisitRequest extends FormRequest
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
                'min:5',
                'max:5'
            ],
            "visit.visit_id" => [
                'required',
                'numeric',
            ],
            "visit.weight" => [
                'required',
                'digitsBetween:1,3',
            ],
            "visit.temperature" => [
                'required',
                'digitsBetween:1,2',
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

            'visit.temperature.required'=>'Необходимо заполнить поле "Вид питомца".',
            'visit.temperature.digit'=>'Поле "Температура" должно содержать только от одного до двух чисел.',

            'visit.pre_diagnosis.required'=>'Необходимо заполнить поле "Предварительный диагноз".',
            'visit.pre_diagnosis.string'=>'Неверные данные в поле "Предварительный диагноз".',
            'visit.pre_diagnosis.max'=>'Превышен лимит символов в поле "Предварительный диагноз"(60).',

            'visit.visit_info.required'=>'Необходимо заполнить поле "Информация приема".',
            'visit.visit_info.string'=>'Неверный формат поля "Информация приема".',
            'visit.visit_info.max'=>'Превышен лимит символов в поле "Информация приема"(1000).',

            'visit.visit_id.required' => '(id)Ручное изменение автоматического заполнения(Required)',
            'visit.visit_id.numeric' => '(id)Ручное изменение автоматического заполнения(Numeric)',

        ];
    }
}
