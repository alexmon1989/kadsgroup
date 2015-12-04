<?php namespace App\Http\Requests;

class StoreArticleRequest extends Request {

    protected $rules = [
        'full_text' => 'required'
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
            'full_text.required' => 'Поле "Текст статьи" обязательно для заполнения.',
        ];
    }

}
