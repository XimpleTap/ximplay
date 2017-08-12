<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 12 Aug 2017 10:49:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Audio
 * 
 * @property int $id
 * @property string $title
 * @property string $audio_path
 * @property string $album_art_path
 * @property string $artist
 * @property string $duration
 *
 * @package App\Models
 */
class Audio extends Eloquent
{
	protected $table = 'audios';
	public $timestamps = false;

	protected $fillable = [
		'title',
		'audio_path',
		'album_art_path',
		'artist',
		'duration'
	];
}
