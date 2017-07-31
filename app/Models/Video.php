<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 31 Jul 2017 02:31:55 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Video
 * 
 * @property int $id
 * @property string $title
 * @property string $video_path
 * @property string $poster_path
 * @property string $subtitle_path
 *
 * @package App\Models
 */
class Video extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'title',
		'video_path',
		'poster_path',
		'subtitle_path'
	];
}
