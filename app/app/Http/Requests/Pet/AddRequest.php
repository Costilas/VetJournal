<?php

namespace App\Http\Requests\Pet;

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
            "pet" => [
               'required',
               'array',
               'min:5',
               'max:5'
            ],
            "pet.pet_name" => [
               'required',
               'alpha',
               'max:20'
            ],
            "pet.kind_id" => [
               'required',
               'digits:1'
            ],
            "pet.gender_id" => [
               'required',
               'digits:1'
            ],
            "pet.birth" => [
               'required',
                'before_or_equal:'. now()->format('Y-m-d'),
            ],
            "pet.owner_id" => [
                'required',
                'numeric'
            ]
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
            'pet.min' => 'Все поля данных питомца должны быть заполнены.',
            'pet.array' => 'Проверьте заполненность всех полей питомца.',
            'pet.required' => 'Все поля формы добавления питомца должны быть заполнены.',

            'pet.pet_name.required'=>'Необходимо заполнить поле "Кличка питомца".',
            'pet.pet_name.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pet.pet_name.max'=>'Привышен лимит символов в поле "Кличка питомца"(20).',

            'pet.kind_id.required'=>'Необходимо заполнить поле "Вид питомца".',
            'pet.kind_id.digit'=>'Неверные данные в поле "Вид питомца".',

            'pet.gender_id.required'=>'Необходимо заполнить поле "Пол питомца".',
            'pet.gender_id.digit'=>'Неверные данные в поле "Пол питомца".',

            'pet.birth.required'=>'Необходимо заполнить поле "Дата рождения питомца".',
            'pet.birth.before_or_equal'=>'Неверный формат поля "Дата рождения питомца". Дата не может быть больше чем текущая.',

            'pet.owner_id.required' => 'Ошибка запроса. Обновите странице и попробуйте снова.',
            'pet.owner_id.numeric' => 'Ошибка запроса. Обновите странице и попробуйте снова.'
        ];
    }
}
