<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property string $username
 * @property string $password
 * @property string $remember_token
 *
 * @package App\Models
 */
class User extends Eloquent
{
	protected $primaryKey = 'username';
	public $incrementing = false;
	public $timestamps = false;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'password',
		'remember_token'
	];
}
