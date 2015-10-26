<?php namespace App\Http\Requests;

class StoreCategoriesRequest extends Request {

    protected $rules = [
        'title' => 'required|max:255',
        'group_category_id' => 'exists:groups_categories,id',
        'parent_id' => 'exists:categories,id',
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
        if (Request::segment(5) == 'create')
        {
            $this->rules['group_category_id'] .= '|required';
        }
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
            'group_category_id.required' => 'Поле "Группа категорий" обязательно для заполнения.',
            'group_category_id.exists' => 'Поле "Группа категорий" должно содержать существующую группу категорий или быть пустым.',
            'parent_id.exists' => 'Поле "Родительская категория" должно содержать существующую категорию или быть пустым.',
        ];
    }

}
