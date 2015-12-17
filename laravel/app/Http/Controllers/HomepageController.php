<?php namespace contoh\Http\Controllers;

use Illuminate\Http\RedirectResponse;

use Request;
use contoh\Profil;
use contoh\Artikel;
use contoh\About;
use contoh\Article;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomepageController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
	$featured_id = Artikel::whereFeatured(true)->latest()->take(5)->get();
	$featured_en = Article::whereFeatured(true)->latest()->take(5)->get();
	return view('homepage.index', compact('featured_id','featured_en'));
	}

	public function search()
	{
	$cari = Request::input('search');
	return redirect()->route('searchresults', compact('cari'));
	}

	#Search
	public function searchresults($cari)
	{

	$profil_id = Profil::where('judul_profil', 'LIKE', '%'.$cari.'%')
							->orWhere('konten', 'LIKE', '%'.$cari.'%')
                  			->latest()->get();

    $artikel_id = Artikel::with('kategori')->where('judul_artikel', 'LIKE', '%'.$cari.'%')
							->orWhere('isi', 'LIKE', '%'.$cari.'%')
                  			->latest()->get();

    $profil_en = About::where('judul_profil', 'LIKE', '%'.$cari.'%')
						->orWhere('konten', 'LIKE', '%'.$cari.'%')
						->latest()->get();

    $artikel_en = Article::with('kategori')->where('judul_artikel', 'LIKE', '%'.$cari.'%')
							->orWhere('isi', 'LIKE', '%'.$cari.'%')
              				->latest()->get();

    #Gabung hasil pencarian halaman INDONESIA
    $hasil_id = array_merge($profil_id->toArray(), $artikel_id->toArray());
    #Pagination Manual
    $perHalaman = 3;
    $total_hasil_id = count($hasil_id);
    $total_halaman = ceil($total_hasil_id / $perHalaman);
    #Cek user menuju halaman yang tidak ada/kembalikan ke page 1
    $page = Request::input('page', 1);
	if ($page > $total_halaman or $page < 1)
	{
	    $page = 1;
	}
	#Hitung halaman mulai per page
	$mulai_halaman = ($page * $perHalaman) - $perHalaman;
	#Bagi hasil sesuai potongan
	$hasil_id = array_slice($hasil_id, $mulai_halaman, $perHalaman);
	#Buat paginasi
	$paginate_id = new Paginator($hasil_id, $total_hasil_id, $perHalaman);
	#Set Path
	$paginate_id->setPath($cari);

	#Gabung hasil pencarian halaman ENGLISH
	$hasil_en = array_merge($profil_en->toArray(), $artikel_en->toArray());
	#Pagination Manual
    $perHalaman = 5;
    $total_hasil_en = count($hasil_en);
    $total_halaman = ceil($total_hasil_en / $perHalaman);
    #Cek user menuju halaman yang tidak ada/kembalikan ke page 1
    $page = Request::input('page', 1);

	if ($page > $total_halaman or $page < 1)
	{
	    $page = 1;
	}
	#Hitung halaman mulai per page
	$mulai_halaman = ($page * $perHalaman) - $perHalaman;
	#Bagi hasil sesuai potongan
	$hasil_en = array_slice($hasil_en, $mulai_halaman, $perHalaman);
	#Buat paginasi
	$paginate_en = new Paginator($hasil_en, $total_hasil_en, $perHalaman);
	#Set Path
	$paginate_en->setPath($cari);

	return view('homepage.search', compact('cari', 
											'hasil_id', 'paginate_id',
											'hasil_en', 'paginate_en'));
	}
}
