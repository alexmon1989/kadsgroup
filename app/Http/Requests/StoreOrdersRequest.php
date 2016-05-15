<?php namespace App\Http\Requests;

class StoreOrdersRequest extends Request {

    protected $rules = [
        'username' => 'required|max:255',
        'phone' => 'required|max:255',
        'email' => 'required|email|max:255',
        'company' => 'max:255',
        'status' => 'required|integer|in:1,2,3',
        'product_title' => 'required|max:255',
        'comments' => '',
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
            'username.required' => 'Поле "ФИО заказчика" обязательно для заполнения.',
            'username.max' => 'Количество символов в поле "ФИО заказчика" не может превышать :max.',
            'phone.required' => 'Поле "Контактный телефон" обязательно для заполнения.',
            'phone.max' => 'Количество символов в поле "Контактный телефон" не может превышать :max.',
            'email.required' => 'Поле "E-Mail" обязательно для заполнения.',
            'email.max' => 'Количество символов в поле "E-Mail" не может превышать :max.',
            'email.email' => 'Поле "E-Mail" должно содержать правильный адрес.',
            'company.max' => 'Количество символов в поле "Компания заказчика" не может превышать :max.',
            'status.required' => 'Поле "Статус заказа" обязательно для заполнения.',
            'status.integer' => 'Поле "Статус заказа" содержит неверное значение.',
            'status.in' => 'Поле "Статус заказа" содержит неверное значение.',
            'product_title.required' => 'Поле "Продукт" обязательно для заполнения.',
            'product_title.max' => 'Количество символов в поле "Ппродукт" не может превышать :max.',
        ];
    }

}
