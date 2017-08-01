<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    //






    // Client video fetch
    public function getVideos(){

    	$videoList = DB::table('videos')->paginate(10);
    	return view('client.client_videolist')->with('videos',$videoList);
    }

    // Client video viewing
    public function watchVideo(Request $request){

    	$videoID = $request->input('video_id');
		$video = DB::table('videos')->where('id',$videoID )->get();
		$video = sizeof($video)==0 ? NULL : $video;
		return view('client.client_videoplayer')->with('video',$video);
    }
}
