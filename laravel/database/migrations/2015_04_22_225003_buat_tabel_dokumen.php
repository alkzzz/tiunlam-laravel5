<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelDokumen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dokumen_artikel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_artikel')->unsigned();
			$table->string('nama_dokumen', 100);
			$table->string('link_dokumen');
			$table->timestamps();

			$table->foreign('id_artikel')->references('id')->on('artikel')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dokumen_artikel');
	}

}
