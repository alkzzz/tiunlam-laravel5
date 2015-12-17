<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class About extends Model {

	protected $table = 'about';

	protected $fillable = ['judul_profil','slug','konten'];

	public function getCreatedAtAttribute()
	{
	    return Date::parse($this->attributes['created_at']);
	}

}
