<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MusicController extends Controller
{
    //

    public function index(){

		$files = \File::allFiles(public_path('audio'));

		$musicPlaylist = array();
		foreach ($files as $file)
		{
		    $remotefilename = public_path('audio/'.basename($file));
			//$getID3 = new \getID3;
			$ThisFileInfo = id3_get_tag($remotefilename);
			

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
				array_push($musicPlaylist,$fileMeta);
			}


			
		}
		dd($musicPlaylist);
		return response()->json($musicPlaylist);

    }
}
