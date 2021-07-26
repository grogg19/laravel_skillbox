<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
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
            'title' => 'required|unique:articles|min:5|max:100',
            'slug' => 'required|unique:articles',
            'excerpt' => 'required|max:255',
            'body' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле ":attribute" должно быть заполнено.',
            'title.unique' => 'Такое значение поля ":attribute" уже существует.',
            'title.max' => 'В поле ":attribute" должно быть меньше :max символов.',
            'title.min' => 'В поле ":attribute" должно быть больше :min символов.',
            'slug.required' => 'Поле ":attribute" должно быть заполнено.',
            'slug.unique' => 'Такое значение поля ":attribute" уже существует.',
            'excerpt.required' => 'Поле ":attribute" должно быть заполнено.',
            'excerpt.max' => 'В поле ":attribute" должно быть меньше :max символов.',
            'body.required' => 'Поле ":attribute" должно быть заполнено.',

        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'excerpt' => 'Краткое содержание',
            'body' => 'Текст статьи'
        ];
    }
}
