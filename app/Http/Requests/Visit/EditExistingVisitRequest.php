<?php

namespace App\Http\Requests\Visit;

use App\DTOs\Visit\UpdateVisitDTO;
use App\Rules\Visit\VisitDecimalRule;
use Illuminate\Foundation\Http\FormRequest;

class EditExistingVisitRequest extends FormRequest
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
                'min:6',
                'max:6'
            ],
            "visit.weight" => [
                'required',
                new VisitDecimalRule('Вес', 2, 3),
            ],
            "visit.temperature" => [
                'required',
                new VisitDecimalRule('Температура', 2, 1),
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
            "visit.treatment" => [
                'required',
                'string',
                'max:500'
            ],
            "visit.user_id" => [
                'required',
                'numeric',
                'exists:users,id'
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

            'visit.treatment.required'=>'Необходимо заполнить поле "Информация приема".',
            'visit.treatment.string'=>'Неверный формат поля "Информация приема".',
            'visit.treatment.max'=>'Превышен лимит символов в поле "Информация приема"(500).',

            'visit.user_id.required' => 'Поле "Кем был проведен прием" является обязательным к заполнению.',
            'visit.user_id.numeric' => 'Поле "Кем был проведен прием" должно содержать только числовое значение.',
            'visit.user_id.exists' => 'Поле "Кем был проведен прием" содержит недопустимое числовое значение.',
        ];
    }

    public function toDTO(): UpdateVisitDTO
    {
        $data = $this->validated()['visit'];

        return new UpdateVisitDTO(
            id: $this->route('id'),
            user_id: $data['user_id'],
            weight: $data['weight'],
            temperature: $data['temperature'],
            pre_diagnosis: $data['pre_diagnosis'],
            visit_info: $data['visit_info'],
            treatment: $data['treatment'],
        );
    }
}
