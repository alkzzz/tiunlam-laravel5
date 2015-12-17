<?php namespace contoh;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {

	protected $table = "document_article";

	protected $fillable = ["id_artikel", "nama_dokumen", "link_dokumen"];

	public function article()
	{
		return $this->belongsTo('contoh\Article', 'id_artikel');
	}

}
