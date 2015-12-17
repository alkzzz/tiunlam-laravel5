<?php namespace contoh\Http\Requests;

use contoh\Http\Requests\Request;
use Entrust;

class UserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Entrust::hasRole('administrator');
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username'=>'required',
			'password'=>'required|min:5|confirmed',
			'email'=>'required|email',
		];
	}

}
