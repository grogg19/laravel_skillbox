<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'email' => 'required|email',
            'body' => 'required',
        ];
    }

    /**
     * get text validation messages
     * @return string[]
     */
    public function messages()
    {
        return [
            'email.required' => 'Поле ":attribute" должно быть заполнено.',
            'email.email' => 'Поле ":attribute" не соответсвует формату Email',
            'body.required' => 'Поле ":attribute" должно быть заполнено.',
        ];
    }

    /**
     * Get text names of fields
     * @return string[]
     */
    public function attributes()
    {
        return [
            'email' => 'Email',
            'body' => 'Текст сообщения'
        ];
    }
}
