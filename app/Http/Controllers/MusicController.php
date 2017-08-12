<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MusicController extends Controller
{
    //


	public function index(){
		Session::put('player_mode');
		// player_mode 1 - Play All
		// player_mode 2 - Play Playlist
		Session::push('player_mode',1);
		$musicList = DB::table('audios')->inRandomOrder()->limit(48)->get();
		Session::put('index_music');
		Session::put('index_music',NULL);
		Session::push('index_music',$musicList);
		Session::save();
		return view('client.client_musiclist')->with('music_list',$musicList);
	}
	public function playMusic(Request $request){

		$musicID = $request->input('music_id');
		$playMode = $request->input('play_mode');
		
		if($playMode>=4 || $playMode<=0){

		}else{
			$music = DB::table('audios')->where('id',$musicID )->get();
			$music = sizeof($music)==0 ? NULL : $music;
			
			return view('client.client_musicplayer')->with(['music'=>$music,'playmode'=>$playMode]);	
		}		
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

		return response()->json(Session::get('my_playlist'));
    }
    public function searchMusic(Request $request){
    	$searchKeys = $request->input('search_keys');
		$music = DB::table('audios')->where('title','like',''.$searchKeys.'%' )->get();
		$music = sizeof($music)==0 ? [] : $music;
		return response()->json($music);
    }

}
