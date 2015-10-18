<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreVideosRequest extends Request
{
    protected $rules = [
        'youtube_id' => 'required|max:255',
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
            'youtube_id.required' => 'Поле "ID Youtube" обязательно для заполнения.',
            'youtube_id.max' => 'Количество символов в поле "ID Youtube" не может превышать :max.',
        ];
    }
}
