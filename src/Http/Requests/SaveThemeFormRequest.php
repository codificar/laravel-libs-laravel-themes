<?php


namespace Codificar\Themes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveThemeFormRequest extends FormRequest
{
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
		return [
			'theme_color' => 'regex:/#(?:[0-9a-f]{6})/',
			'primary_color' => 'regex:/#(?:[0-9a-f]{6})/',
			'secondary_color' => 'regex:/#(?:[0-9a-f]{6})/',
			'hover_color' => 'regex:/#(?:[0-9a-f]{6})/',
			'active_color' => 'regex:/#(?:[0-9a-f]{6})/',
		];
	}

	protected function prepareForValidation()
	{
		if($this->has('id')) {
			$theme = Theme::find($this->input('id'));
			$this->merge([
				'theme' => $theme
			]);
		}
	}

	public function messages()
	{
		return [];
	}

	/**
	 * Retorna um json caso a validação falhe.
	 * 
	 * @throws HttpResponseException
	 * @return json
	 */
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(
			response()->json([
				'success' => false,
				'errors' => $validator->errors()->all(),
				'error_code' => \ApiErrors::REQUEST_FAILED
			])
		);
	}
}
