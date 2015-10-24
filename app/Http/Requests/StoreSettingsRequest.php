<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreSettingsRequest extends Request
{
    protected $rules = [
        'email_to' => 'required|email',
        'footer_about' => 'required',
        'footer_contacts' => 'required',
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
            'email_to.required' => 'Поле "E-Mail, куда приходят сообщения с формы обратной связи" обязательно для заполнения.',
            'email_to.email' => 'Поле "E-Mail, куда приходят сообщения с формы обратной связи" должно быть действительным электронным адресом.',
            'footer_about.required' => 'Поле "Текст о компании в "подвале"" обязательно для заполнения.',
            'footer_contacts.required' => 'Поле "Текст контактов компании в "подвале"" обязательно для заполнения.',
        ];
    }
}
