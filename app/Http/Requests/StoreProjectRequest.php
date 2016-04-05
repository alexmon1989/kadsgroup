<?php namespace App\Http\Requests;

class StoreProjectRequest extends Request {

    protected $rules = [
        'title'             => 'required|max:255',
        'slug'              => 'max:255',
        'description_short' => 'required',
        'description_full'  => '',
        'enabled'           => 'boolean',
        'image'             => 'image',
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
            $this->rules['image'] .= '|required';
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
            'title.required'                => 'Поле "Название" обязательно для заполнения.',
            'title.max'                     => 'Количество символов в поле "Название" не может превышать :max.',
            'slug.max'                      => 'Количество символов в поле "Slug" не может превышать :max.',
            'description_short.required'    => 'Поле "Описание короткое" обязательно для заполнения.',
            'enabled.boolean'               => 'Поле "Включено" должно иметь значение логического типа.',
            'image.image'                   => 'Поле "Изображение" должно быть изображением.',
            'image.required'                => 'Поле "Изображение" обязательно для заполнения.',
        ];
    }

}
