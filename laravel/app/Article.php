<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Article extends Model {
 
	protected $fillable = ['judul_artikel', 'kategori_id', 'slug', 'isi', 'gambar', 'dokumen', 'featured'];

	public function getCreatedAtAttribute()
	{
	    return Date::parse($this->attributes['created_at']);
	}

	public function kategori()
	{
		return $this->belongsTo('contoh\KategoriArtikel', 'kategori_id');
	}

	public function document()
	{
		return $this->hasMany('contoh\Document', 'id_artikel');
	}

}
