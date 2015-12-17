<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use contoh\Dosen;
use Auth;

class DosenController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $dosen = Dosen::whereNip(Auth::user()->username)->firstOrFail();
    	return view('dosen.home', compact('dosen'));
    }

}
