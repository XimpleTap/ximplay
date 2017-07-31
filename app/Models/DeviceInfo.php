<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DeviceInfo
 * 
 * @property string $bus_plate_number
 *
 * @package App\Models
 */
class DeviceInfo extends Eloquent
{
	protected $table = 'device_info';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'bus_plate_number'
	];
}
