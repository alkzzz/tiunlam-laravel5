<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App;

use contoh\Profil;
use contoh\About;
use contoh\Http\Requests\ProfilRequest;

use Jenssegers\Date\Date;
use Illuminate\Database\QueryException;

class ProfilController extends Controller {

	public function __construct()
	{
	$this->middleware('auth', ['except' => ['daftarprofil', 'showprofil_id','showprofil_en']]);
	}

	public function showprofil_id($slug)
	{
	$profil = Profil::whereSlug($slug)->firstOrFail();

	return view('profil.showprofil', compact('profil'));
	}

	public function showprofil_en($slug)
	{
	$profil = About::whereSlug($slug)->firstOrFail();

	return view('profil.showprofil', compact('profil'));
	}

	public function tambahprofil_id()
	{
		return view('profil.tambahprofil_id');
	}

	public function tambahprofil_en()
	{
		return view('profil.tambahprofil_en');
	}

	public function simpanprofil_id(ProfilRequest $request)
	{
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_profil'));

		try 
		{
		Profil::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul profil yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-profil_id')->with('message', 'Profil baru telah ditambahkan...');
	
	}

	public function simpanprofil_en(ProfilRequest $request)
	{
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_profil'));

		try 
		{
		About::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul profil yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-profil_en')->with('message', 'Profil baru telah ditambahkan...');
	
	}

	public function editprofil_id($slug)
	{
		$profil = Profil::whereSlug($slug)->firstOrFail();
		return view('profil.editprofil_id', compact('profil'));
	}

	public function editprofil_en($slug)
	{
		$profil = About::whereSlug($slug)->firstOrFail();
		return view('profil.editprofil_en', compact('profil'));
	}

	public function updateprofil_id(ProfilRequest $request, $slug)
	{
		$profil = Profil::whereSlug($slug)->firstOrFail();
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_profil'));

		try 
		{
		$profil->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul profil yang anda masukkan sudah ada dalam database.');
		}
		
		return redirect()->route('admin-profil_id')->with('message', 'Profil telah diupdate...');

	}

	public function updateprofil_en(ProfilRequest $request, $slug)
	{
		$profil = About::whereSlug($slug)->firstOrFail();
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_profil'));

		try 
		{
		$profil->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul profil yang anda masukkan sudah ada dalam database.');
		}
		
		return redirect()->route('admin-profil_en')->with('message', 'Profil telah diupdate...');

	}

	public function showdeleteprofil_id($slug)
	{
		$profil = Profil::whereSlug($slug)->firstOrFail();
		return view('profil.showdeleteprofil_id', compact('profil'));
	}

	public function deleteprofil_id($slug)
	{
		$profil = Profil::whereSlug($slug)->firstOrFail();

		$profil->delete();

		return redirect()->route('admin-profil_id')->with('message', 'Profil telah dihapus...');
	}

	public function showdeleteprofil_en($slug)
	{
		$profil = About::whereSlug($slug)->firstOrFail();
		return view('profil.showdeleteprofil_en', compact('profil'));
	}

	public function deleteprofil_en($slug)
	{
		$profil = About::whereSlug($slug)->firstOrFail();

		$profil->delete();

		return redirect()->route('admin-profil_en')->with('message', 'Profil telah dihapus...');
	}


}
