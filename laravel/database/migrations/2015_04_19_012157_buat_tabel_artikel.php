<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelArtikel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('artikel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('kategori_id')->unsigned();
			$table->string('judul_artikel', 50);
			$table->string('slug', 50)->unique();
			$table->text('isi');
			$table->string('gambar');
			$table->boolean('featured')->default(false);
			$table->timestamps();

			$table->foreign('kategori_id')->references('id')->on('kategori_artikel')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('artikel');
	}

}
