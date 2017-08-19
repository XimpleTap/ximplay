<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Audio;

class AdminMusicController extends Controller
{
    public function __construct(){
        
    }

    public function musicForm(){
        return view('music.uploadform');
    }

    public function musicList(Request $request){

        $musicUpload = $request->except('_token');
        $requestKeys = array();
        
        $uploadCount = sizeof($musicUpload['music-title']);
        $musicUpload['file'] = array_reverse($musicUpload['file']);
        $uploadMessage = array();
        $j=0;
        
        for($i=0; $i<$uploadCount; $i++){
            $audio = new Audio;
            for($j=0; $j<$uploadCount; $j++){
                if($musicUpload['file'][$j]->getClientOriginalName()==$musicUpload['music-file'][$i]){

                    $file = $musicUpload['file'][$j];
                    $origFileName = $file->getClientOriginalName();
                    $destinationPath = config('app.MUSIC_UPLOAD_DIR');
                    $filename = $this->filterWhiteSpace($musicUpload['music-title'][$i]);
                    $file->move($destinationPath,$filename.'.mp3');

                    if($musicUpload['music-album-art'][$i]!=NULL){
                        $base64_str = substr($musicUpload['music-album-art'][$i], strpos($musicUpload['music-album-art'][$i], ",")+1);
                    //decode base64 string

                        $image = base64_decode($base64_str);
                        file_put_contents($destinationPath.'\\'.$musicUpload['music-title'][$i].'.jpg',$image);
                        $audio->album_art_path = '/music/'.$musicUpload['music-title'][$i].'.jpg';
                    }else{
                        $audio->album_art_path = '/images/defaultmusic.jpg';
                    }
                    
                
                    $audio->title = $musicUpload['music-title'][$i];
                    $audio->artist = $musicUpload['music-artist'][$i];
                    $audio->audio_path = '/music/'.$filename.'.mp3';
                    $audio->save();

                    array_push($uploadMessage,[
                        "message"=>$filename.' uploaded successfully!'
                    ]);
                }
            }
        }
        
        return view('music.list',array('data'=>$uploadMessage));         
        /*foreach(Input::file('file') as $file){
            $origFileName = $file->getClientOriginalName();
            $destinationPath = config('app.MUSIC_UPLOAD_DIR');
            $filename = $this->filterWhiteSpace($origFileName);
            $getId3 = new \getID3;
            $fileInfo = $getId3->analyze($file->getRealPath());
            $file->move($destinationPath,$filename);  
            $fileLocation = $destinationPath.$filename;
            //TODO: set metadata upon user invoke of edit
            //$this->setMetadata($fileLocation,$origFileName);
        }
        $viewData = Input::file('file');
        return view('music.list',array('data'=>$viewData));*/
    }

    private function filterWhiteSpace($str){
        return preg_replace('/\s+/', '_', $str);
    }

    private function setMetadata($file){
        $TextEncoding = 'UTF-8';
        $getId3 = new \getID3;
        $fileInfo = $getId3->analyze($file);
        
        dump($fileInfo);
        exit();
    }
}
