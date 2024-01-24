<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class AttachNewPetsToOwnerRequest extends FormRequest
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
            "pets" => [
                'required',
                'array',
                'min:1',
            ],
            "pets.*.pet_name" => [
                'required',
                'alpha',
                'max:20'
            ],
            "pets.*.kind_id" => [
                'required',
                'digits:1',
                'exists:kinds,id'
            ],
            "pets.*.gender_id" => [
                'required',
                'digits:1',
                'exists:genders,id'
            ],
            "pets.*.castration_condition_id" => [
                'required',
                'digits:1',
                'exists:castration_conditions,id'
            ],
            "pets.*.birth" => [
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
            'pets.*.min' => 'Все поля данных питомца должны быть заполнены.',
            'pets.*.array' => 'Проверьте заполненность всех полей питомца.',
            'pets.*.required' => 'Все поля формы добавления питомца должны быть заполнены.',

            'pets.*.pet_name.required'=>'Необходимо заполнить поле "Кличка питомца".',
            'pets.*.pet_name.alpha'=>'Поле "Кличка питомца" не должно содержать числа и специальные символы.',
            'pets.*.pet_name.max'=>'Привышен лимит символов в поле "Кличка питомца"(30).',

            'pets.*.kind_id.required'=>'Необходимо заполнить поле "Вид питомца".',
            'pets.*.kind_id.digit'=>'Неверные данные в поле "Вид питомца".',
            'pets.*.kind_id.exists'=>'Несуществующий id в поле "Вид питомца".',

            'pets.*.gender_id.required'=>'Необходимо заполнить поле "Пол питомца".',
            'pets.*.gender_id.digit'=>'Неверные данные в поле "Пол питомца".',
            'pets.*.gender_id.exists'=>'Несуществующий id в поле "Пол питомца".',

            'pets.*.castration_condition_id.required'=>'Необходимо заполнить поле "Кастрация питомца".',
            'pets.*.castration_condition_id.digit'=>'Неверные данные в поле "Кастрация питомца".',
            'pets.*.castration_condition_id.exists'=>'Несуществующий id в поле "Кастрация питомца".',

            'pets.*.birth.required'=>'Необходимо заполнить поле "Дата рождения питомца".',
            'pets.*.birth.before_or_equal'=>'Неверный формат поля "Дата рождения питомца". Дата не может быть больше чем текущая.',

            'pets.*.owner_id.required' => 'Ошибка запроса. Обновите странице и попробуйте снова.',
            'pets.*.owner_id.numeric' => 'Ошибка запроса. Обновите странице и попробуйте снова.',
            'pets.*.owner_id.exists'=> 'Ошибка запроса. Обновите странице и попробуйте снова.',
        ];
    }
}
