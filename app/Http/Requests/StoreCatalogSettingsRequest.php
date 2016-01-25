<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCatalogSettingsRequest extends Request
{
    protected $rules = [
        'full_text'         => 'required',
        'page_title'        => '',
        'page_keywords'     => '',
        'page_description'  => '',
        'page_h1'           => '',
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
            'full_text.required' => 'Поле "Описание" обязательно для заполнения.',
        ];
    }
}
