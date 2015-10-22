<?php

namespace App\Http\Requests;

class StoreCompanyDescriptionsRequest extends Request {

    protected $rules = [
        'title' => 'required|max:255',
        'file_main' => 'image',
        'file_logo' => 'image',
        'description' => 'required',
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
            'title.required' => 'Поле "Название" обязательно для заполнения.',
            'title.max' => 'Количество символов в поле "Название" не может превышать :max.',
            'description.required' => 'Поле "Описание" обязательно для заполнения.',
        ];
    }
}