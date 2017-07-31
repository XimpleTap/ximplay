<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ad
 * 
 * @property int $id
 * @property string $image_path
 * @property \Carbon\Carbon $ad_end
 *
 * @package App\Models
 */
class Ad extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'ad_end'
	];

	protected $fillable = [
		'image_path',
		'ad_end'
	];
}
