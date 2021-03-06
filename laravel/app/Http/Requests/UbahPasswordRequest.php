<?php namespace contoh\Http\Requests;

use contoh\Http\Requests\Request;
use Auth;

class UbahPasswordRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'password'=>'confirmed|min:5',
		];
	}

	public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }

}
