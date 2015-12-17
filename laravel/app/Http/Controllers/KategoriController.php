<?php namespace contoh\Http\Controllers;

use contoh\Http\Requests;
use contoh\Http\Controllers\Controller;

use Illuminate\Http\Request;
use contoh\KategoriArtikel;

use contoh\Http\Requests\KategoriRequest;

use contoh\Artikel;
use contoh\Article;

class KategoriController extends Controller {

    public function artikelkategori_id($slug)
    {
        $kategori = KategoriArtikel::whereSlug_id($slug)->firstOrFail();
        $id = $kategori->id;
        $daftar_artikel = Artikel::whereKategori_id($id)->latest()
                        ->paginate(5)->setPath($slug);
                                    
        return view('kategori.artikelkategori_id', compact('daftar_artikel', 'slug'));
    }

    public function artikelkategori_en($slug)
    {
        $kategori = KategoriArtikel::whereSlug_en($slug)->firstOrFail();
        $id = $kategori->id;
        $daftar_artikel = Article::whereKategori_id($id)->latest()
                        ->paginate(5)->setPath($slug);

        return view('kategori.artikelkategori_en', compact('daftar_artikel', 'slug'));
    }

    public function tambahkategori()
    {
    	return view('kategori.tambahkategori');
    }

    public function simpankategori(KategoriRequest $request)
    {
    	$input = $request->all();
    	$input['slug_id'] = str_slug($request->input('nama_id'));
    	$input['slug_en'] = str_slug($request->input('nama_en'));

    	try 
		{
		KategoriArtikel::create($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Kategori yang anda masukkan sudah ada dalam database.');
		}

		return redirect()->route('admin-kategori')->with('message', 'Kategori baru telah ditambahkan...');
    }

    public function editkategori($slug)
    {
    	$kategori = KategoriArtikel::whereSlug_id($slug)->firstOrFail();
    	return view('kategori.editkategori', compact('kategori'));
    }

    public function updatekategori(KategoriRequest $request, $slug)
    {
    	$kategori = KategoriArtikel::whereSlug_id($slug)->firstOrFail();

    	$input = $request->all();
    	$input['slug_id'] = str_slug($request->input('nama_id'));
		$input['slug_en'] = str_slug($request->input('nama_en'));

		try 
		{
		$kategori->update($input);
		} 
		catch (QueryException $e) {
		    return redirect()->back()->with('error', 'Kategori yang anda masukkan sudah ada dalam database.');
		}
		

		return redirect()->route('admin-kategori')->with('message', 'Kategori telah diupdate...');
    }

    public function showdeletekategori($slug)
    {
    	$kategori = KategoriArtikel::whereSlug_id($slug)->firstOrFail();
    	return view('kategori.showdeletekategori', compact('kategori'));
    }


	public function deletekategori($slug)
	{
		$kategori = KategoriArtikel::whereSlug_id($slug)->firstOrFail();

		$kategori->delete();

		return redirect()->route('admin-kategori')->with('message', 'Kategori telah dihapus...');
	}

}
