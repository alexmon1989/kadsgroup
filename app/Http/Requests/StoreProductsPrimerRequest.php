<?php namespace App\Http\Requests;

class StoreProductsPrimerRequest extends Request {

    protected $rules = [
        'title'                     => 'required|max:255',
        'category_id'               => 'required|exists:categories,id',
        'photo'                     => 'image',
        'package'                   => 'required|max:255',
        'description_small'         => 'required|max:255',
        'description_full'          => '',
        'using'                     => '',
        'tech_characteristics'      => '',
        'exec_works'                => '',
        'application'               => '',
        'properties_using'          => '',
        'phys_chem_properties'      => '',
        'restrictions'              => '',
        'safety'                    => '',
        'general_characteristics'   => '',
        'price_1_name'              => 'max:255',
        'price_1_val'               => 'max:255',
        'price_2_name'              => 'max:255',
        'price_2_val'               => 'max:255',
        'price_3_name'              => 'max:255',
        'price_3_val'               => 'max:255',
        'price_4_name'              => 'max:255',
        'price_4_val'               => 'max:255',
        'enabled'                   => 'boolean',
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
            'category_id.required' => 'Поле "Категория" обязательно для заполнения.',
            'category_id.exists' => 'Поле "Категория" должно существовать.',
            'photo.required' => 'Поле "Изображение" обязательно для заполнения.',
            'photo.image' => 'Поле "Изображение" должно быть изображением.',
            'package.required' => 'Поле "Упаковка" обязательно для заполнения.',
            'package.max' => 'Количество символов в поле "Упаковка" не может превышать :max.',
            'description_small.required' => 'Поле "Описание короткое" обязательно для заполнения.',
            'description_small.max' => 'Количество символов в поле "Описание короткое" не может превышать :max.',
            'price_1_name.max' => 'Количество символов в поле "Цена 1: Название поля" не может превышать :max.',
            'price_1_val.max' => 'Количество символов в поле "Цена 1: Значение" не может превышать :max.',
            'price_2_name.max' => 'Количество символов в поле "Цена 2: Название поля" не может превышать :max.',
            'price_2_val.max' => 'Количество символов в поле "Цена 2: Значение" не может превышать :max.',
            'price_3_name.max' => 'Количество символов в поле "Цена 3: Название поля" не может превышать :max.',
            'price_3_val.max' => 'Количество символов в поле "Цена 3: Значение" не может превышать :max.',
            'price_4_name.max' => 'Количество символов в поле "Цена 4: Название поля" не может превышать :max.',
            'price_4_val.max' => 'Количество символов в поле "Цена 4: Значение" не может превышать :max.',
            'enabled.boolean' => 'Поле "Включено" должно иметь значение логического типа.',
        ];
    }

}
