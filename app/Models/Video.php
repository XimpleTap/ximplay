<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 14 Aug 2017 08:26:34 +0000.
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
 * @property string $duration
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
		'subtitle_path',
		'duration'
	];
}
