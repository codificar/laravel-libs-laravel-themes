<?php

namespace Codificar\Themes\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveAppPreferenceRequest extends FormRequest
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
			'type' => 'required',
            'theme_id' => 'required'
		];
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