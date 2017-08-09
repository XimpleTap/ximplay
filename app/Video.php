<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Video extends Model
{
    protected $table = 'videos';
    public $timestamps = false;

    public function saveVideo($data){
        $videoInstance = new Video();
        $videoInstance->title = $data['movieTitle'];
        $videoInstance->video_path = $data['moviePath'];
        $videoInstance->poster_path = $data['posterPath'];
        $videoInstance->subtitle_path = $data['subtitlePath'];
        $status = $videoInstance->save();
        return $status;
    }

    public function fetchAllMovies(){
         return DB::table('videos')->get();
    }
}
