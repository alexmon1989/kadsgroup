<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePriceListsRequest extends Request
{
    protected $rules = [
        'file_name' => 'max:15000',
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

    public function messages()
    {
        return [
            'file_name.max' => 'Максимальный размер - 15 Мб.',
        ];
    }
}
