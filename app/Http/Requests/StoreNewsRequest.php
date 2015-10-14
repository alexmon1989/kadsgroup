<?php namespace App\Http\Requests;

class StoreNewsRequest extends Request {

    protected $rules = [
        'title' => 'required|max:255',
        'full_text' => 'required',
        'preview_text_mid' => 'required',
        'preview_text_small' => 'required_if:is_on_main,1',
        'is_on_main' => 'boolean',
        'thumbnail' => 'image',
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
        if (Request::segment(3) == 'create')
        {
            $this->rules['thumbnail'] .= '|required';
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
            'preview_text_mid.required' => 'Поле "Текст для списка новостей" обязательно для заполнения.',
            'preview_text_small.required_if' => 'Поле "Текст для виджета на главной" обязательно для заполнения, когда включена опция "Показывать в виджете на главной странице".',
            'full_text.required' => 'Поле "Текст полный" обязательно для заполнения.',
            'is_on_main.boolean' => 'Поле "Показывать в виджете на главной странице" должно иметь значение логического типа.',
            'thumbnail.image' => 'Поле "Изображение" должно быть изображением.',
            'thumbnail.required' => 'Поле "Изображение" обязательно для заполнения.',
        ];
    }

}
