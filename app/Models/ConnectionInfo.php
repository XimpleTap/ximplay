<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ConnectionInfo
 * 
 * @property int $id
 * @property string $name
 * @property int $age
 * @property string $email_mobile
 * @property \Carbon\Carbon $created_on
 *
 * @package App\Models
 */
class ConnectionInfo extends Eloquent
{
	protected $table = 'connection_info';
	public $timestamps = false;

	protected $casts = [
		'age' => 'int'
	];

	protected $dates = [
		'created_on'
	];

	protected $fillable = [
		'name',
		'age',
		'email_mobile',
		'created_on'
	];
}
