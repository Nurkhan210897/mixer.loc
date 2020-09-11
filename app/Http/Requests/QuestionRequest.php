<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'name' => 'required',
            'question' => 'required',
            'email' => 'required|email:rfc,dns'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ФИО не заполнено!',
            'question.required' => 'Вопрос не задан!',
            'email.required' => 'Email не заполнен!',
            'email.email' => 'Не верный формат email!'
        ];
    }
}
