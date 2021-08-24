<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'body' => 'required|min:2|max:300',

        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'Поле ":attribute" должно быть заполнено.',
            'body.max' => 'В поле ":attribute" должно быть меньше :max символов.',
            'body.min' => 'В поле ":attribute" должно быть больше :min символов.',

        ];
    }

    public function attributes()
    {
        return [
            'body' => 'Оставить комментарий'
        ];
    }
}
