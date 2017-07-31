<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Connection
 * 
 * @property int $id
 * @property string $mac_address
 * @property string $ip_address
 * @property \Carbon\Carbon $connection_time
 *
 * @package App\Models
 */
class Connection extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'connection_time'
	];

	protected $fillable = [
		'mac_address',
		'ip_address',
		'connection_time'
	];
}
