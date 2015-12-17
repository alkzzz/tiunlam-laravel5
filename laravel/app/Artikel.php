<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Artikel extends Model {

	protected $table = "artikel";
 
	protected $fillable = ['judul_artikel', 'kategori_id', 'slug', 'isi', 'gambar', 'dokumen', 'featured'];

	public function getCreatedAtAttribute()
	{
	    return Date::parse($this->attributes['created_at']);
	}

	public function kategori()
	{
		return $this->belongsTo('contoh\KategoriArtikel', 'kategori_id');
	}

	public function dokumen()
	{
		return $this->hasMany('contoh\Dokumen', 'id_artikel');
	}

}
		