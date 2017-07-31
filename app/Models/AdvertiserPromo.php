<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdvertiserPromo
 * 
 * @property int $id
 * @property string $image_path
 * @property \Carbon\Carbon $promo_end
 *
 * @package App\Models
 */
class AdvertiserPromo extends Eloquent
{
	protected $table = 'advertiser_promo';
	public $timestamps = false;

	protected $dates = [
		'promo_end'
	];

	protected $fillable = [
		'image_path',
		'promo_end'
	];
}
