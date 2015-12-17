<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelProfil extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profil', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('judul_profil', 50);
			$table->string('slug', 50)->unique();
			$table->text('konten');
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
		Schema::drop('profil');
	}

}
