<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class KategoriArtikel extends Model {

	protected $table = "kategori_artikel";

	protected $fillable = ['nama_id','slug_id', 'nama_en', 'slug_en'];

	public function getCreatedAtAttribute()
	{
	    return Date::parse($this->attributes['created_at']);
	}

	public function artikel()
	{
		return $this->hasMany('contoh\Artikel', 'kategori_id');
	}
	
	public function articles()
	{
		return $this->hasMany('contoh\Article', 'kategori_id');
	}
}
