<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCertificatesSettingsRequest extends Request
{
    protected $rules = [
        'title' => 'max:255',
        'full_text' => '',
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
            'title.max' => 'Количество символов в поле "Заголовок" не может превышать :max.',
        ];
    }
}
