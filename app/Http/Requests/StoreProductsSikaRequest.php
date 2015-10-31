<?php namespace App\Http\Requests;

class StoreProductsSikaRequest extends Request {

    protected $rules = [
        'title'             => 'required|max:255',
        'description'       => '',
        'package'           => '',
        'package_list'      => 'max:255',
        'characteristics'   => '',
        'using_area'        => '',
        'photo'             => 'image',
        'category_id'       => 'required|exists:categories,id',
        'enabled'           => 'boolean',
        'tech_cart_file'    => 'mimes:pdf',
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
        if (Request::segment(6) == 'create')
        {
            $this->rules['photo'] .= '|required';
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
            'package_list.max' => 'Количество символов в поле "Упаковка (для страницы со списком товаров)" не может превышать :max.',
            'photo.required' => 'Поле "Изображение" обязательно для заполнения.',
            'photo.image' => 'Поле "Изображение" должно быть изображением.',
            'category_id.required' => 'Поле "Категория" обязательно для заполнения.',
            'category_id.exists' => 'Поле "Категория" должно существовать.',
            'enabled.boolean' => 'Поле "Включено" должно иметь значение логического типа.',
            'tech_cart_file.mimes' => 'Поле "Тех. карта" должно содержать файл pdf.',
        ];
    }

}
