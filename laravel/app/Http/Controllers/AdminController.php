<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Hash;
use contoh\User;
use contoh\Profil;
use contoh\About;
use contoh\KategoriArtikel;
use contoh\Artikel;
use contoh\Article;
use contoh\Http\Requests\UbahPasswordRequest;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function homepage()
    {
        $featured_id = Artikel::whereFeatured(true)->latest()->take(5)->get();
        $featured_en = Article::whereFeatured(true)->latest()->take(5)->get();
    	return view('homepage.index', compact('featured_id','featured_en'));
    }

    public function dashboard()
    {
        return view('admin.dashboard', compact('user'));
    }

    public function user()
    {
        $users = User::with('roles')->oldest()->paginate(5);
        return view('admin.user', compact('users'));
    }

    public function ubahpassword()
    {
        return view('admin.ubahpassword');
    }

    public function updatepassword(UbahPasswordRequest $request)
    {
        $user = Auth::user();
        $input = $request->all();

        $password_lama = $request->input('password_lama');

        if (!Hash::check($password_lama, $user->password))
        {
            return redirect()->back()->with('error', 'Password lama yang anda masukkan salah.');
        }

        if ($request->input('password') == '')
        {
            $input['password'] = $user->password;
        }
        else
        {
            $input['password'] = bcrypt($request->input('password'));
        }

        return redirect()->route('dosen-home')->with('message', 'Profil user telah diupdate...');

    }

    public function profil_id()
    {
        $daftarprofil = Profil::latest()
                        ->paginate(5)->setPath('id');

        return view('admin.profil_id', compact('daftarprofil'));
    }

    public function profil_en()
    {
        $aboutlist = About::latest()
                        ->paginate(5)->setPath('en');

        return view('admin.profil_en', compact('aboutlist'));
    }

    public function kategori()
    {
        $daftar_kategori = KategoriArtikel::latest()
                        ->paginate(5)->setPath('kategori-artikel');

        return view('admin.kategori', compact('daftar_kategori'));
    }

    public function artikel_id()
    {
        $daftar_artikel = Artikel::with('kategori')->latest()
                        ->paginate(5)->setPath('id');

        return view('admin.artikel_id', compact('daftar_artikel'));
    }

    public function artikel_en()
    {
        $article_list = Article::with('kategori')->latest()
                        ->paginate(5)->setPath('en');

        return view('admin.artikel_en', compact('article_list'));
    }

    public function search(Request $request)
    {
        $cari = $request->input('search');
        return redirect()->route('adminsearchresults', compact('cari'));
    }

    public function searchresults(Request $request, $cari)
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

    #Gabung hasil pencarian
    $hasil_profil = array_merge($profil_id->toArray(), $profil_en->toArray());
    $hasil_artikel = array_merge($artikel_id->toArray(), $artikel_en->toArray());
    $hasil_admin = array_merge($hasil_profil, $hasil_artikel);

    #Pagination Manual
    $perHalaman = 3;
    $total_hasil_admin = count($hasil_admin);
    $total_halaman = ceil($total_hasil_admin / $perHalaman);
    #Cek user menuju halaman yang tidak ada/kembalikan ke page 1
    $page = $request->input('page', 1);
    if ($page > $total_halaman or $page < 1)
    {
        $page = 1;
    }
    #Hitung halaman mulai per page
    $mulai_halaman = ($page * $perHalaman) - $perHalaman;
    #Bagi hasil sesuai potongan
    $hasil_admin = array_slice($hasil_admin, $mulai_halaman, $perHalaman);
    #Buat paginasi
    $paginate_admin = new Paginator($hasil_admin, $total_hasil_admin, $perHalaman);
    #Set Path
    $paginate_admin->setPath($cari);


    return view('admin.search', compact('cari','hasil_admin', 'paginate_admin'));
    }
}
