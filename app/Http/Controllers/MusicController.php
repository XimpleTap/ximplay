<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class MusicController extends Controller
{
    //

    public function index(){
    	$searchResult = array();
		$files = \File::allFiles(public_path('music'));
		$musicID=0;
		shuffle($files);
		$files = array_slice($files, 0, 36);

		$musicList = array();

		foreach ($files as $file)
		{
			$musicID++;
		    $remotefilename = public_path('music/'.basename($file));
			$getID3 = new \getID3;
			$ThisFileInfo = $getID3->analyze($remotefilename);
			

			$picture = @$ThisFileInfo['id3v2']['APIC'][0]['data'];

	        //$picture = @$ThisFileInfo['comments']['picture'][0]['data'];
	        $type = @$ThisFileInfo['id3v2']['APIC'][0]['image_mime'];
	        
			$albumArt = !empty($picture) == true ? 'data:image/png;charset=utf-8;base64,' . base64_encode($picture) : NULL;

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
		
		return view('client.client_musiclist')->with('music_list',$musicList);
    }

    public function playMusic(Request $request){

    	$musicFile = $request->input('music_file');
    
   		if (!File::exists(public_path('music/'.basename($musicFile))))
		{
		   return view('client.client_musicplayer')->with('music',NULL);
		}
		
    	$remotefilename = public_path('music/'.basename($musicFile));
		$getID3 = new \getID3;
		$ThisFileInfo = $getID3->analyze($remotefilename);

		$picture = @$ThisFileInfo['id3v2']['APIC'][0]['data'];
	        //$picture = @$ThisFileInfo['comments']['picture'][0]['data'];
        $type = @$ThisFileInfo['id3v2']['APIC'][0]['image_mime'];
        
		$albumArt = !empty($picture) == true ? 'data: ' . $type . ';base64,' . base64_encode($picture) : NULL;
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

    public function fetchAllMusic(){

    	$files = \File::allFiles(public_path('music'));

		$musicList = array();
		foreach ($files as $file)
		{
		    $remotefilename = public_path('music/'.basename($file));
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
		
		Session::put('music_storage');
		Session::push('music_storage',null);
		Session::push('music_storage',$musicList);
		Session::save();
    }

    public function searchMusic(Request $request){

    	$searchKeys = $request->input('search_keys');


    }

}
