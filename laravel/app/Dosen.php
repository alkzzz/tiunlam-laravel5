<?php namespace contoh;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Dosen extends Model implements AuthenticatableContract {

	use Authenticatable, CanResetPassword;

	protected $table = "dosen";

	protected $primaryKey = "NIP";
}
