<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model {

	protected $table = "dokumen_artikel";

	protected $fillable = ["id_artikel", "nama_dokumen", "link_dokumen"];

	public function artikel()
	{
		return $this->belongsTo('contoh\Artikel', 'id_artikel');
	}


}
