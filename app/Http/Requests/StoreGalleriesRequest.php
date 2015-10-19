<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreGalleriesRequest extends Request
{
    protected $rules = [
        'title' => 'required|max:255',
        'file_name' => 'image',
        'is_main' => 'boolean',
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
            $this->rules['file_name'] .= '|required';
        }
        return $this->rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "Название" обязательно для заполнения.',
            'title.max' => 'Количество символов в поле "Название" не может превышать :max.',
            'file_name.image' => 'Поле "Изображение" должно быть изображением.',
            'file_name.required' => 'Поле "Изображение" обязательно для заполнения.',
            'is_main.boolean' => 'Поле "Главное фото галереи" обязательно для заполнения.',
        ];
    }
}
