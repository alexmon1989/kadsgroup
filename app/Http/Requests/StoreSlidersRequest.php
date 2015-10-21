<?php

namespace App\Http\Requests;

class StoreSlidersRequest extends Request {

    protected $rules = [
        'file_main' => 'image',
        'file_logo' => 'image',
        'url' => 'required|url|max:255',
        'text_1' => 'required|max:255',
        'text_2' => 'required|max:255',
        'css_main' => '',
        'css_1' => '',
        'css_2' => '',
        'css_3' => '',
    ];

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
        if (Request::segment(3) == 'create')
        {
            $this->rules['file_main'] .= '|required';
            $this->rules['file_logo'] .= '|required';
        }
        return $this->rules;
    }

    /**
     * Сообщения ошибок
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file_main.image' => 'Поле "Изображение фоновое" должно быть изображением.',
            'file_main.required' => 'Поле "Изображение фоновое" обязательно для заполнения.',
            'file_logo.image' => 'Поле "Изображение лого" должно быть изображением.',
            'file_logo.required' => 'Поле "Изображение лого" обязательно для заполнения.',
            'url.required' => 'Поле "Ссылка (полная)" обязательно для заполнения.',
            'url.max' => 'Количество символов в поле "Ссылка (полная)" не может превышать :max.',
            'url.url' => 'Поле "Ссылка (полная)" должно содержать правильную ссылку.',
            'text_1.required' => 'Поле "Текст 1" обязательно для заполнения.',
            'text_1.required' => 'Поле "Текст 2" обязательно для заполнения.',
            'text_1.max' => 'Количество символов в поле "Текст 1" не может превышать :max.',
            'text_2.max' => 'Количество символов в поле "Текст 2" не может превышать :max.',
        ];
    }
}