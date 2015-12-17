<?php namespace contoh\Http\Requests;

use contoh\Http\Requests\Request;
use Entrust;

class KategoriRequest extends Request {

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
			'nama_id'=> 'required',
			'nama_en' => 'required',
		];
	}

	public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }

}
