<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatKategoriArtikel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kategori_artikel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama_id', 50);
			$table->string('slug_id', 50)->unique();
			$table->string('nama_en', 50);
			$table->string('slug_en', 50)->unique();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kategori_artikel');
	}

}
