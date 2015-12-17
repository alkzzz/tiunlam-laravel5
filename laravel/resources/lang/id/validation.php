<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute harus diterima.",
	"active_url"           => "URL :attribute tidak valid.",
	"after"                => "tanggal :attribute harus setelah :date.",
	"alpha"                => ":attribute hanya boleh mengandung huruf.",
	"alpha_dash"           => ":attribute hanya boleh mengandung huruf, angka, dan tanda-hubung(dash).",
	"alpha_num"            => ":attribute hanya boleh mengandung huruf dan angka.",
	"array"                => ":attribute harus berupa array.",
	"before"               => "tanggal :attribute harus sebelum :date..",
	"between"              => [
		"numeric" => ":attribute tidak boleh kurang dari :min dan lebih dari :max.",
		"file"    => ":attribute tidak boleh kurang dari :min dan lebih dari :max kilobytes.",
		"string"  => ":attribute tidak boleh kurang dari :min dan lebih dari :max karakter.",
		"array"   => ":attribute tidak boleh kurang dari :min dan lebih dari :max item.",
	],
	"boolean"              => ":attribute harus berupa nilai benar atau salah.",
	"confirmed"            => "Konfirmasi :attribute tidak cocok",
	"date"                 => "Format tanggal :attribute tidak valid.",
	"date_format"          => ":attribute tidak cocok dengan format tanggal :format.",
	"different"            => ":attribute dan :other tidak boleh sama.",
	"digits"               => ":attribute harus memiliki :digits digit.",
	"digits_between"       => ":attribute tidak boleh kurang dari :min digit dan lebih dari :max digit.",
	"email"                => ":attribute harus merupakan email yang valid.",
	"exists"               => ":attribute tersebut tidak valid.",
	"image"                => ":attribute harus berekstensi jpeg, png, bmp, gif, atau svg.",
	"in"                   => ":attribute tersebut tidak valid.",
	"integer"              => ":attribute harus berupa integer.",
	"ip"                   => ":attribute harus merupakan IP address yang valid.",
	"max"                  => [
		"numeric" => ":attribute tidak boleh lebih dari :max.",
		"file"    => ":attribute tidak boleh lebih dari :max kilobytes.",
		"string"  => ":attribute tidak boleh lebih dari :max characters.",
		"array"   => ":attribute tidak boleh lebih dari :max items.",
	],
	"mimes"                => "File :attribute harus berupa file: :values.",
	"min"                  => [
		"numeric" => ":attribute tidak boleh kurang dari :min.",
		"file"    => ":attribute tidak boleh kurang dari :min kilobytes.",
		"string"  => ":attribute tidak boleh kurang dari :min karakter.",
		"array"   => ":attribute tidak boleh kurang dari :min item.",
	],
	"not_in"               => ":attribute tersebut tidak valid.",
	"numeric"              => ":attribute harus berupa angka.",
	"regex"                => "Format :attribute tidak valid.",
	"required"             => ":attribute tidak boleh kosong.",
	"required_if"          => ":attribute field tidak boleh kosong apabila :other bernilai :value.",
	"required_with"        => ":attribute field tidak boleh kosong apabila terdapat :values.",
	"required_with_all"    => ":attribute field tidak boleh kosong apabila terdapat :values.",
	"required_without"     => ":attribute field tidak boleh kosong apabila tidak terdapat :values.",
	"required_without_all" => ":attribute field tidak boleh kosong apabila tidak terdapat :values.",
	"same"                 => ":attribute dan :other harus sama.",
	"size"                 => [
		"numeric" => ":attribute harus berukuran :size.",
		"file"    => ":attribute harus berukuran :size kilobytes.",
		"string"  => ":attribute harus berukuran :size characters.",
		"array"   => ":attribute harus mengandung :size item.",
	],
	"unique"               => ":attribute telah digunakan.",
	"url"                  => "Format :attribute tidak valid.",
	"timezone"             => ":attribute harus merupakan zona yang valid.",
	"login_gagal"   	   => "Username atau password yang anda masukkan salah.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'gambar' => [
			'required' => 'Gambar tidak boleh kosong bila ingin ditampilkan di slider halaman depan.',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => ['judul'=>'Judul', 
					'isi'=>'Isi',
					'username'=>'Username',
					'password'=>'Password', 
					'email'=>'Alamat E-Mail',
					'gambar'=>'Gambar', 
					'NIP'=>'NIP',
					'judul'=>'Judul',
					'konten'=>'Konten',
					'nama_id'=>'Kategori (ID)',
					'nama_en'=>'Kategori (EN)',
					'display_name'=>'Nama Role',
					'description'=>'Deskripsi Role',
					],


];
