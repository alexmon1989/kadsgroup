<?php

namespace App\Http\Requests;

class ContactsMessageRequest extends Request {
    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|min:10',
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
            'name.required' => 'Будь-ласка, введіть ваше ім\'я',
            'name.max' => 'Кількість символів у полі "Ваше ім\'я" не може перевищувати :max.',
            'email.required' => 'Будь-ласка, введіть Вашу електронну адресу.',
            'email.max' => 'Кількість символів у полі "Ваше ім\'я" не може перевищувати :max.',
            'email.email' => 'Будь-ласка, введіть Вашу ПРАВИЛЬНУ електронну адресу.',
            'message.required' => 'Будь-ласка, введіть повідомлення',
            'message.min' => 'Повідомлення має містити не менше 10 символів.',
        ];
    }
}