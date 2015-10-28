<?php namespace App\Http\Requests;

class StoreGroupsCategoriesRequest extends Request {

    protected $rules = [
        'title' => 'required|max:255',
        'enabled' => 'boolean',
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
            'title.required' => 'Поле "Название" обязательно для заполнения.',
            'title.max' => 'Количество символов в поле "Название" не может превышать :max.',
            'enabled.boolean' => 'Поле "Включено" должно иметь значение логического типа.',
        ];
    }

}
