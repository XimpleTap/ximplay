<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MusicController extends Controller
{
    //

    public function index(){

		$files = \File::allFiles(public_path('audio'));

		$musicList = array();
		foreach ($files as $file)
		{
		    $remotefilename = public_path('audio/'.basename($file));
			$getID3 = new \getID3;
			$ThisFileInfo = $getID3->analyze($remotefilename);
			

			$picture = @$ThisFileInfo['id3v2']['APIC'][0]['data'];
	        //$picture = @$ThisFileInfo['comments']['picture'][0]['data'];
	        $type = @$ThisFileInfo['id3v2']['APIC'][0]['image_mime'];
	        
			$albumArt = !empty($picture) == true ? $base64 = 'data:' . $type . ';base64,' . base64_encode($picture) : NULL;

			if(!empty($ThisFileInfo['tags']['id3v2']['title']) && !empty($ThisFileInfo['tags']['id3v2']['artist'])){
				$fileMeta = [
					"filename" => basename($remotefilename),
					"music_title" => $ThisFileInfo['tags']['id3v2']['title'][0],
					"music_artist" => $ThisFileInfo['tags']['id3v2']['artist'][0],
					"music_duration" => $ThisFileInfo['playtime_string'],
					"album_art" => $albumArt
				];
				array_push($musicList,$fileMeta);
			}


			
		}
		shuffle($musicList);
		return view('client.client_musiclist')->with('music_list',$musicList);
    }

    public function playMusic(Request $request){

    	$musicFile = $request->input('music_file');

    	if (!File::exists(public_path('audio/'.basename($musicFile))))
		{
		   return view('client.client_musicplayer')->with('music',NULL);
		}
		
    	$remotefilename = public_path('audio/'.basename($musicFile));
		$getID3 = new \getID3;
		$ThisFileInfo = $getID3->analyze($remotefilename);

		$picture = @$ThisFileInfo['id3v2']['APIC'][0]['data'];
	        //$picture = @$ThisFileInfo['comments']['picture'][0]['data'];
        $type = @$ThisFileInfo['id3v2']['APIC'][0]['image_mime'];
        
		$albumArt = !empty($picture) == true ? $base64 = 'data:' . $type . ';base64,' . base64_encode($picture) : NULL;
		if(!empty($ThisFileInfo['tags']['id3v2']['title']) && !empty($ThisFileInfo['tags']['id3v2']['artist'])){
			$fileMeta = [
				"filename" => basename($remotefilename),
				"music_title" => $ThisFileInfo['tags']['id3v2']['title'][0],
				"music_artist" => $ThisFileInfo['tags']['id3v2']['artist'][0],
				"music_duration" => $ThisFileInfo['playtime_string'],
				"album_art" => $albumArt
			];

		}else{
			$fileMeta = NULL;
		}	

    	return view('client.client_musicplayer')->with('music',$fileMeta);
    }

    public function addToPlaylist(Request $request){

    	if(empty(Session::get('my_playlist'))){
    		Session::put('my_playlist');
			Session::push('my_playlist',$request->input('music_data'));
			Session::save();
		}else{

			if(!in_array($request->input('music_data'),Session::get('my_playlist'))){
				Session::push('my_playlist',$request->input('music_data'));
				Session::save();
			}
			
		}
    }
}
