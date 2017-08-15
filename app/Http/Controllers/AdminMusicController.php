<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdminMusicController extends Controller
{
    public function musicForm(){
        return view('music.uploadform');
    }

    public function musicList(Request $request){
        foreach(Input::file('file') as $file){
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
        return view('music.list',array('data'=>$viewData));
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
