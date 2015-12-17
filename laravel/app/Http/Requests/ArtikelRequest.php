<?php namespace contoh\Http\Requests;

use contoh\Http\Requests\Request;
use Entrust;

class ArtikelRequest extends Request {

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

    $rule = $this->isFeatured(Request::input('featured') and Request::input('gambar_saat_ini')==null);
		
		return [
			'judul_artikel'=> 'required',
			'isi' => 'required',
			'gambar'=> $rule,
		];
	}

	public function forbiddenResponse()
    {
        return response()->view('errors.403');
    }


	protected function isFeatured($tampil)
    { 
        return ($tampil == true) ? 'image|required' : 'image';
    }

}
