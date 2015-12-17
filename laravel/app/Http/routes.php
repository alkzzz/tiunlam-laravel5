<?php
use contoh\Profil;
use contoh\About;
use contoh\KategoriArtikel;

#ViewShare
if (Schema::hasTable('profil') and Schema::hasTable('about') and Schema::hasTable('kategori_artikel'))
{
    View::share('daftarprofil', Profil::oldest()->get());
    View::share('aboutlist', About::oldest()->get());
    View::share('kategori_artikel', KategoriArtikel::oldest()->get());
}

$bahasa = Request::segment(1);

if (in_array($bahasa, Config::get('app.bahasa'))) {
    App::setLocale($bahasa);
} else {
    $bahasa = 'id';
}

#RouteGroup MultiLanguage
Route::group(['prefix' => $bahasa], function()
{
Route::get('/', ['as'=>'home', 'uses'=> 'HomepageController@index']);
#Search
Route::post('search', ['as'=>'search', 'uses'=>'HomepageController@search']);
Route::get('search/{cari}', ['as'=>'searchresults', 'uses'=>'HomepageController@searchresults']);
#AdminHome
Route::get('home', ['as'=>'admin-homepage', 'uses'=>'AdminController@homepage']);
#Profil
#Showprofil - ID
Route::get('profil/{slug}', ['as'=>'showprofil_id', 'uses'=>'ProfilController@showprofil_id']);
#Showprofil - EN
Route::get('about/{slug}', ['as'=>'showprofil_en', 'uses'=>'ProfilController@showprofil_en']);
#Berita
#RouteDinamis (Paling Bawah)
Route::get('{kategori_artikel}', ['as'=>'daftar_kategori', 'uses'=>'ArtikelController@kategori_artikel']);
Route::get('{kategori_artikel}/{slug}', ['as'=>'tampil_artikel', 'uses'=>'ArtikelController@tampil_artikel']);
});
#END RouteGroup MultiLang

#Authentication
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

#RoutePermission
Entrust::routeNeedsRole('admin', 'administrator');
Entrust::routeNeedsRole('admin/*', 'administrator');
Entrust::routeNeedsRole('dosen', 'dosen');
Entrust::routeNeedsRole('dosen/*', 'dosen');

Route::get('ubahpassword', ['as'=>'ubahpassword', 'uses'=>'AdminController@ubahpassword']);
Route::post('updatepassword', ['as'=>'updatepassword', 'uses'=>'AdminController@updatepassword']);

#Admin
Route::get('admin', ['as'=>'dashboard', 'uses'=>'AdminController@dashboard']);
#SearchAdmin
Route::post('admin/search', ['as'=>'adminsearch', 'uses'=>'AdminController@search']);
Route::get('admin/search/{cari}', ['as'=>'adminsearchresults', 'uses'=>'AdminController@searchresults']);
#User
Route::get('admin/user', ['as'=>'admin-user', 'uses'=>'AdminController@user']);
#TambahUser
Route::get('admin/tambahuser', ['as'=>'tambahuser', 'uses'=>'UserController@tambahuser']);
Route::post('admin/simpanuser', ['as'=>'simpanuser', 'uses'=>'UserController@simpanuser']);
#EditUser
Route::get('admin/edituser/{username}', ['as'=>'edituser', 'uses'=>'UserController@edituser']);
Route::patch('admin/updateuser/{username}', ['as'=>'updateuser', 'uses'=>'UserController@updateuser']);
#DeleteUser
Route::get('admin/showdeleteuser/{username}', ['as'=>'showdeleteuser', 'uses'=>'UserController@showdeleteuser']);
Route::delete('admin/deleteuser/{username}', ['as'=>'deleteuser', 'uses'=>'UserController@deleteuser']);
#Role
Route::get('admin/role', ['as'=>'admin-role', 'uses'=>'UserController@role']);
#TambahRole
Route::get('admin/tambahrole', ['as'=>'tambahrole', 'uses'=>'UserController@tambahrole']);
Route::post('admin/simpanrole', ['as'=>'simpanrole', 'uses'=>'UserController@simpanrole']);
#EditRole
Route::get('admin/editrole/{nama}', ['as'=>'editrole', 'uses'=>'UserController@editrole']);
Route::patch('admin/updaterole/{nama}', ['as'=>'updaterole', 'uses'=>'UserController@updaterole']);
#DeleteRole
Route::get('admin/showdeleterole/{nama}', ['as'=>'showdeleterole', 'uses'=>'UserController@showdeleterole']);
Route::delete('admin/deleterole/{nama}', ['as'=>'deleterole', 'uses'=>'UserController@deleterole']);
#Profil
#DaftarProfil
Route::get('admin/profil/id', ['as'=>'admin-profil_id', 'uses'=>'AdminController@profil_id']);
Route::get('admin/profil/en', ['as'=>'admin-profil_en', 'uses'=>'AdminController@profil_en']);
#TambahProfil
Route::get('admin/profil/tambah/id', ['as'=>'tambahprofil_id', 'uses'=>'ProfilController@tambahprofil_id']);
Route::post('admin/profil/simpan/id', ['as'=>'simpanprofil_id', 'uses'=>'ProfilController@simpanprofil_id']);
Route::get('admin/profil/tambah/en', ['as'=>'tambahprofil_en', 'uses'=>'ProfilController@tambahprofil_en']);
Route::post('admin/profil/simpan/en', ['as'=>'simpanprofil_en', 'uses'=>'ProfilController@simpanprofil_en']);
#EditProfil
Route::get('admin/profil/{slug}/edit/id', ['as'=>'editprofil_id', 'uses'=>'ProfilController@editprofil_id']);
Route::patch('admin/profil/{slug}/id', ['as'=>'updateprofil_id', 'uses'=>'ProfilController@updateprofil_id']);
Route::get('admin/profil/{slug}/edit/en', ['as'=>'editprofil_en', 'uses'=>'ProfilController@editprofil_en']);
Route::patch('admin/profil/{slug}/en', ['as'=>'updateprofil_en', 'uses'=>'ProfilController@updateprofil_en']);
#DeleteProfil
Route::get('admin/profil/{slug}/delete/id', ['as'=>'showdeleteprofil_id', 'uses'=>'ProfilController@showdeleteprofil_id']);
Route::delete('admin/profil/{slug}/id', ['as'=>'deleteprofil_id', 'uses'=>'ProfilController@deleteprofil_id']);
Route::get('admin/profil/{slug}/delete/en', ['as'=>'showdeleteprofil_en', 'uses'=>'ProfilController@showdeleteprofil_en']);
Route::delete('admin/profil/{slug}/en', ['as'=>'deleteprofil_en', 'uses'=>'ProfilController@deleteprofil_en']);
#Kategori
#DaftarKategoriArtikel
Route::get('admin/kategori-artikel', ['as'=>'admin-kategori', 'uses'=>'AdminController@kategori']);
Route::get('admin/kategori-artikel/en/{slug}', ['as'=>'admin-kategoriartikel_en', 'uses'=>'KategoriController@artikelkategori_en']);
Route::get('admin/kategori-artikel/id/{slug}', ['as'=>'admin-kategoriartikel_id', 'uses'=>'KategoriController@artikelkategori_id']);
#TambahKategori
Route::get('admin/kategori-artikel/tambah', ['as'=>'tambahkategori', 'uses'=>'KategoriController@tambahkategori']);
Route::post('admin/kategori-artikel', ['as'=>'simpankategori', 'uses'=>'KategoriController@simpankategori']);
#EditKategori
Route::get('admin/kategori-artikel/{slug}/edit', ['as'=>'editkategori', 'uses'=>'KategoriController@editkategori']);
Route::patch('admin/kategori-artikel/{slug}', ['as'=>'updatekategori', 'uses'=>'KategoriController@updatekategori']);
#DeleteKategori
Route::get('admin/kategori-artikel/{slug}/delete', ['as'=>'showdeletekategori', 'uses'=>'KategoriController@showdeletekategori']);
Route::delete('admin/kategori-artikel/{slug}', ['as'=>'deletekategori', 'uses'=>'KategoriController@deletekategori']);
#Berita
#DaftarArtikel
Route::get('admin/artikel/id', ['as'=>'admin-artikel_id', 'uses'=>'AdminController@artikel_id']);
Route::get('admin/artikel/en', ['as'=>'admin-artikel_en', 'uses'=>'AdminController@artikel_en']);
#Tambahberita (ID dan EN)
Route::get('admin/artikel/tambah/id', ['as'=>'tambahartikel_id', 'uses'=>'ArtikelController@tambah_artikel_id']);
Route::get('admin/artikel/tambah/en', ['as'=>'tambahartikel_en', 'uses'=>'ArtikelController@tambah_artikel_en']);
Route::post('admin/artikel/simpan/id', ['as'=>'simpanartikel_id', 'uses'=>'ArtikelController@simpan_artikel_id']);
Route::post('admin/artikel/simpan/en', ['as'=>'simpanartikel_en', 'uses'=>'ArtikelController@simpan_artikel_en']);
#Editartikel
Route::get('admin/artikel/{slug}/edit/id', ['as'=>'editartikel_id', 'uses'=>'ArtikelController@edit_artikel_id']);
Route::patch('admin/artikel/{slug}/id', ['as'=>'updateartikel_id', 'uses'=>'ArtikelController@update_artikel_id']);
Route::get('admin/artikel/{slug}/edit/en', ['as'=>'editartikel_en', 'uses'=>'ArtikelController@edit_artikel_en']);
Route::patch('admin/artikel/{slug}/en', ['as'=>'updateartikel_en', 'uses'=>'ArtikelController@update_artikel_en']);
#Deleteartikel
Route::get('admin/artikel/{slug}/delete/id', ['as'=>'showdeleteartikel_id', 'uses'=>'ArtikelController@showdeleteartikel_id']);
Route::get('admin/artikel/{slug}/delete/en', ['as'=>'showdeleteartikel_en', 'uses'=>'ArtikelController@showdeleteartikel_en']);
Route::delete('admin/artikel/{slug}/id', ['as'=>'deleteartikel_id', 'uses'=>'ArtikelController@deleteartikel_id']);
Route::delete('admin/artikel/{slug}/en', ['as'=>'deleteartikel_en', 'uses'=>'ArtikelController@deleteartikel_en']);

#EditDokumen
Route::get('admin/dokumen/edit/id', ['as'=>'editdokumen_id', 'uses'=>'ArtikelController@editdokumen_id']);
Route::get('admin/dokumen/edit/en', ['as'=>'editdokumen_en', 'uses'=>'ArtikelController@editdokumen_en']);
#Tambah
Route::post('admin/dokumen/simpan/id', ['as'=>'simpandokumen_id', 'uses'=>'ArtikelController@simpandokumen_id']);
Route::post('admin/dokumen/simpan/en', ['as'=>'simpandokumen_en', 'uses'=>'ArtikelController@simpandokumen_en']);
#Delete
Route::delete('admin/dokumen/delete/id', ['as'=>'deletedokumen_id', 'uses'=>'ArtikelController@deletedokumen_id']);
Route::delete('admin/dokumen/delete/en', ['as'=>'deletedokumen_en', 'uses'=>'ArtikelController@deletedokumen_en']);

#Dosen #Login
Route::get('dosen', ['as'=>'dosen-home', 'uses'=>'DosenController@home']);














