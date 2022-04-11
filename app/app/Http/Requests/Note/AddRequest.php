<?php

namespace App\Http\Requests\Note;

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
            'status_id'=>'digits:1|required',
            'theme'=>'string|required|max:25',
            'body'=>'string|required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'status_id.digits' => 'Ошибка запроса. Обновите странице и попробуйте снова.',
            'status_id.required' => 'Ошибка запроса. Обновите странице и попробуйте снова.',

            'theme.string' => 'Поле "Тема заметки" имеет неверный формат.',
            'theme.required' => 'Поле "Тема заметки" обязательно к заполнению.',
            'theme.max' => 'В поле "Тема заметки" превышен лимит символов(25).',

            'body.string' => 'Поле "Текст заметки" меет неверный формат.',
            'body.required' => 'Поле "Текст заметки" обязательно к заполнению.',
            'body.max' => 'Поле "Текст заметки" превышен лимит символов(255).',
        ];
    }

}
