<?php namespace contoh\Http\Controllers\Auth;

use contoh\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Entrust;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/


	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => array('getLogout','getRegister','postRegister')]);
	}

	protected function getFailedLoginMessage()
	{
		return trans('error.gagal-login');
	}

	public function getRegister()
        {
    	if ($this->auth->guest())
    	{
    		return redirect('/');
    	}
	    elseif (Entrust::hasRole('dosen'))
	    {
	    	return redirect('/dosen');
	    }
	    else
	    {
	    	return view('auth.register');
	    }
        }

	public function postLogin(Request $request)
	{
		$this->validate($request, [
			'username' => 'required', 
			'password' => 'required',
		]);

		$credentials = $request->only('username', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect('testing');
		}

		return redirect($this->loginPath())
					->withInput($request->only('username', 'remember'))
					->withErrors([
						'username' => $this->getFailedLoginMessage(),
					]);
	}

}
