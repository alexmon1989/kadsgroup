<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreContactsRequest extends Request
{
    protected $rules = [
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
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
            'latitude.required' => 'Поле "Широта" обязательно для заполнения.',
            'longitude.required' => 'Поле "Долгота" обязательно для заполнения.',
            'latitude.numeric' => 'Поле "Широта" должно содержать числовое значение.',
            'longitude.numeric' => 'Поле "Долгота" должно содержать числовое значение.',
        ];
    }
}
