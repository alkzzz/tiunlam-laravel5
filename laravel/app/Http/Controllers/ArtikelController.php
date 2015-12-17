<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use contoh\Http\Requests\ArtikelRequest;
use Illuminate\Database\QueryException;
use App;

use contoh\KategoriArtikel;
use contoh\Artikel;
use contoh\Article;
use contoh\Dokumen;
use contoh\Document;
use Image;
use File;
use Session;

class ArtikelController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['kategori_artikel', 'tampil_artikel']]);
	}

	public function kategori_artikel($kategori_artikel)
	{
		if (App::getLocale()=='id')
		{
		$kategori = KategoriArtikel::with('artikel')->whereSlug_id($kategori_artikel)	
													->firstOrFail();
		}
		else
		{
		$kategori = KategoriArtikel::with('articles')->whereSlug_en($kategori_artikel)	
													->firstOrFail();
		}
		return view('artikel.kategori_artikel', compact('kategori'));
	}

	public function tampil_artikel($kategori_artikel, $slug)
	{
		if (App::getLocale()=='id')
		{
		$artikel = Artikel::whereSlug($slug)->firstOrFail();
		}
		else
		{
		$artikel = Article::whereSlug($slug)->firstOrFail();
		}
		return view('artikel.tampil_artikel', compact('artikel'));
	}

	public function tambah_artikel_id()
	{
		$kategori = KategoriArtikel::oldest()->get();
		return view('artikel.tambah_artikel_id', compact('kategori'));
	}

	public function tambah_artikel_en()
	{
		$kategori = KategoriArtikel::oldest()->get();
		return view('artikel.tambah_artikel_en', compact('kategori'));
	}

	public function simpan_artikel_id(ArtikelRequest $request)
	{
		$input = $request->except('dokumen');
		$input['slug'] = str_slug($request->input('judul_artikel'));	
		//dd($input);	

   		if ($request->hasFile('gambar')) 
   		{
        $gambar         = $input['gambar'];
        $namafile       = $gambar->getClientOriginalName();
        $save_path 		= 'uploads/gambar/';
        $resize         = Image::make($gambar->getRealPath())
        				  ->resize('1000','400')
        				  ->save($save_path . $input['slug']. '-' .$namafile);

        $input['gambar'] = $save_path . $input['slug']. '-' .$namafile;
		}
		else
		{
			$input['gambar'] = '';
		}

		try 
		{
		$sukses = Artikel::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul artikel yang anda masukkan sudah ada dalam database.');
		}

		if ($sukses)
		{
		if ($request->hasFile('dokumen'))
		{
		$artikel = Artikel::whereSlug($input['slug'])->firstOrFail();

		$dokumen = $request->file('dokumen');

		foreach ($dokumen as $file) {

			$save_path = 'uploads/dokumen/';
			$namafile = $file->getClientOriginalName();
			$file->move($save_path, $input['slug']. '-' .$namafile);

			Dokumen::create(['id_artikel'=>$artikel->id,
							 'nama_dokumen'=>$namafile,
							 'link_dokumen'=>$save_path . $input['slug']. '-' .$namafile]);
		}
		}
		return redirect()->route('admin-artikel_id')->with('message', 'Artikel baru telah ditambahkan...');
		}
	}

	public function simpan_artikel_en(ArtikelRequest $request)
	{
		$input = $request->except('dokumen');
		$input['slug'] = str_slug($request->input('judul_artikel'));

   		if ($request->hasFile('gambar')) 
   		{
        $gambar         = $input['gambar'];
        $namafile       = $gambar->getClientOriginalName();
        $save_path 		= 'uploads/gambar/';
        $resize         = Image::make($gambar->getRealPath())
        				  ->resize('1000','400')
        				  ->save($save_path . $input['slug']. '-' .$namafile);

        $input['gambar'] = $save_path . $input['slug']. '-' .$namafile;
		}
		else
		{
			$input['gambar'] = '';
		}

		try 
		{
		$sukses = Article::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul artikel yang anda masukkan sudah ada dalam database.');
		}

		if ($sukses)
		{
		if ($request->hasFile('dokumen'))
		{
		$artikel = Article::whereSlug($input['slug'])->firstOrFail();

		$dokumen = $request->file('dokumen');

		foreach ($dokumen as $file) {

			$save_path = 'uploads/dokumen/';
			$namafile = $file->getClientOriginalName();
			$file->move($save_path, $input['slug']. '-' .$namafile);

			Document::create(['id_artikel'=>$artikel->id,
							  'nama_dokumen'=>$namafile,
							  'link_dokumen'=>$save_path . $input['slug']. '-' .$namafile]);
		}
		}
		return redirect()->route('admin-artikel_en')->with('message', 'Artikel baru telah ditambahkan...');
		}
		
	}

	public function edit_artikel_id($slug)
	{
		$artikel = Artikel::with('kategori')->whereSlug($slug)->firstOrFail();
		$kategori = KategoriArtikel::where('id', '!=', $artikel->kategori->id)->get();
		return view('artikel.edit_artikel_id', compact('kategori', 'artikel'));
	}

	public function update_artikel_id(ArtikelRequest $request, $slug)
	{
		$artikel = Artikel::whereSlug($slug)->firstOrFail();
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_artikel'));

		if ($request->input('gambar_saat_ini') == null)
		{
		$input['gambar'] = '';
		}

		if ($request->input('featured') == null)
		{
		$input['featured'] = false;
		}

		if ($request->hasFile('gambar')) 
   		{
        $gambar         = $request->file('gambar');
        $namafile       = $gambar->getClientOriginalName();
        $save_path 		= 'uploads/gambar/';
        $resize         = Image::make($gambar->getRealPath())
        				  ->resize('1000','400')
        				  ->save($save_path . $input['slug']. '-' .$namafile);

        $input['gambar'] = $save_path . $input['slug']. '-' .$namafile;
		}
		else
		{
		$input['gambar'] = $request->input('gambar_saat_ini');
		}

		if ($request->input('featured') == null)
		{
		$input['featured'] = false;
		$input['gambar'] = '';
		}

		try 
		{
		$artikel->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul artikel yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-artikel_id')->with('message', 'Artikel telah diupdate...');

	}

	public function edit_artikel_en($slug)
	{
		$artikel = Article::with('kategori')->whereSlug($slug)->firstOrFail();
		$kategori = KategoriArtikel::where('id', '!=', $artikel->kategori->id)->get();
		return view('artikel.edit_artikel_en', compact('kategori', 'artikel'));
	}

	public function update_artikel_en(ArtikelRequest $request, $slug)
	{
		$artikel = Article::whereSlug($slug)->firstOrFail();
		$input = $request->all();
		$input['slug'] = str_slug($request->input('judul_artikel'));

		if ($request->input('gambar_saat_ini') == null)
		{
		$input['gambar'] = '';
		}

		if ($request->hasFile('gambar')) 
   		{
        $gambar         = $request->file('gambar');
        $namafile       = $gambar->getClientOriginalName();
        $save_path 		= 'uploads/gambar/';
        $resize         = Image::make($gambar->getRealPath())
        				  ->resize('1000','400')
        				  ->save($save_path . $input['slug']. '-' .$namafile);

        $input['gambar'] = $save_path . $input['slug']. '-' .$namafile;
		}
		else
		{
		$input['gambar'] = $request->input('gambar_saat_ini');
		}

		if ($request->input('featured') == null)
		{
		$input['featured'] = false;
		$input['gambar'] = '';
		}

		try 
		{
		$artikel->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Judul artikel yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-artikel_en')->with('message', 'Artikel telah diupdate...');

	}

	public function showdeleteartikel_id($slug)
	{
		$artikel = Artikel::whereSlug($slug)->firstOrFail();
		$isi_artikel = $artikel->isi;
	
		return view('artikel.showdeleteartikel_id', compact('artikel'));
	}

	public function deleteartikel_id($slug)
	{
		$artikel = Artikel::with('dokumen')->whereSlug($slug)->firstOrFail();
		$isi_artikel = $artikel->isi;

		File::delete($artikel->gambar);

		#delete gambar tinymce
		if (str_contains($isi_artikel, '<img'))
		{
		preg_match_all('/src="([^"]+)"/', $isi_artikel, $gambar);
		foreach ($gambar[1] as $img) 
			{
			$link_gambar = substr($img, 8); # nama website+2 -> /contoh/ = 8 karakter
			File::delete($link_gambar);
			}
		}
		#delete dokumen
		foreach ($artikel->dokumen as $dokumen)
		{
			File::delete($dokumen->link_dokumen);
		}
	
		$artikel->delete();

		return redirect()->route('admin-artikel_id')->with('message', 'Artikel telah dihapus...');
	}

	public function showdeleteartikel_en($slug)
	{
		$artikel = Article::whereSlug($slug)->firstOrFail();

		return view('artikel.showdeleteartikel_en', compact('artikel'));
	}

	public function deleteartikel_en($slug)
	{
		$artikel = Article::with('document')->whereSlug($slug)->firstOrFail();
		$isi_artikel = $artikel->isi;

		File::delete($artikel->gambar);

		#delete gambar tinymce
		if (str_contains($isi_artikel, '<img'))
		{
		preg_match_all('/src="([^"]+)"/', $isi_artikel, $gambar);
		foreach ($gambar[1] as $img) 
			{
			$link_gambar = substr($img, 8); # nama webiste -> /contoh/ = 8 karakter
			File::delete($link_gambar);
			}
		}

		foreach ($artikel->document as $dokumen)
		{
			File::delete($dokumen->link_dokumen);
		}
	
		$artikel->delete();

		return redirect()->route('admin-artikel_en')->with('message', 'Artikel telah dihapus...');
	}

	public function editdokumen_id()
	{
		$id_artikel= Session::get('id_artikel');
		$artikel = Artikel::with('dokumen')->findOrFail($id_artikel);
		return view('artikel.editdokumen_id', compact('id_artikel', 'artikel'));
	}

	public function editdokumen_en()
	{
		$id_artikel= Session::get('id_artikel');
		$artikel = Article::with('document')->findOrFail($id_artikel);
		return view('artikel.editdokumen_en', compact('id_artikel', 'artikel'));
	}

	public function simpandokumen_id(Request $request)
	{
	$id_artikel= Session::get('id_artikel');
	$artikel = Artikel::findOrFail($id_artikel);
	$slug = $artikel->slug;

		if($request->hasFile('dokumen'))
		{
		$dokumen = $request->file('dokumen');

		foreach ($dokumen as $file) 
			{
			$save_path = 'uploads/dokumen/';
			$namafile = $file->getClientOriginalName();
			$file->move($save_path, $slug .'-'. $namafile);

			Dokumen::create(['id_artikel'=>$artikel->id,
							  'nama_dokumen'=>$namafile,
							  'link_dokumen'=>$save_path .  $slug .'-'. $namafile]);
			}
		return redirect()->route('editartikel_id', $artikel->slug);
		}
		else 
		{
		return redirect()->back()->with('error', 'Tidak ada file yang ditambahkan.');
		}
	}

	public function simpandokumen_en(Request $request)
	{
	$id_artikel= Session::get('id_artikel');
	$artikel = Article::findOrFail($id_artikel);
	$slug = $artikel->slug;

		if($request->hasFile('dokumen'))
		{
		$dokumen = $request->file('dokumen');

		foreach ($dokumen as $file) 
			{
			$save_path = 'uploads/dokumen/';
			$namafile = $file->getClientOriginalName();
			$file->move($save_path, $slug .'-'. $namafile);

			Document::create(['id_artikel'=>$artikel->id,
							  'nama_dokumen'=>$namafile,
							  'link_dokumen'=>$save_path . $slug .'-'. $namafile]);
			}
		return redirect()->route('editartikel_en', $artikel->slug);
		}
		else 
		{
		return redirect()->back()->with('error', 'Tidak ada file yang ditambahkan.');
		}
	}

	public function deletedokumen_id(Request $request)
	{
	$id_artikel= Session::get('id_artikel');
	$artikel = Artikel::with('dokumen')->findOrFail($id_artikel);

		if($request->has('checklist_dokumen'))
		{
		$checked_delete = $request->input('checklist_dokumen');

			foreach ($checked_delete as $id)
			{
				$dokumen = Dokumen::findOrFail($id);
				$dokumen->delete();
				File::delete($dokumen->link_dokumen);
			}
		return redirect()->route('editartikel_id', $artikel->slug);
		}
		else 
		{
		return redirect()->back()->with('error', 'Tidak ada file yang didelete.');
		}
	}

	public function deletedokumen_en(Request $request)
	{
	$id_artikel= Session::get('id_artikel');
	$artikel = Article::with('document')->findOrFail($id_artikel);

		if($request->has('checklist_dokumen'))
		{
		$checked_delete = $request->input('checklist_dokumen');

			foreach ($checked_delete as $id)
			{
				$dokumen = Document::findOrFail($id);
				$dokumen->delete();
				File::delete($dokumen->link_dokumen);
			}
		return redirect()->route('editartikel_en', $artikel->slug);
		}
		else 
		{
		return redirect()->back()->with('error', 'Tidak ada file yang didelete.');
		}
	}
}