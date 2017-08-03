<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
 use Illuminate\Support\Facades\Log;


class VideoController extends Controller
{
    public function uploadForm(){
        return view('video.uploadform');
    }

    public function upload(Request $request){
        $validateVideo = $this->validateVideoUpload(Input::file('file'));
        if($validateVideo){

            try{
                $file = $request->file('file');
                $destinationPath = config('app.VIDEO_UPLOAD_DIR');

                $file->move($destinationPath,$file->getClientOriginalName());    
                 
            } catch (Exception $e) {

                Log::error("AppVideo::upload()  " . $e->getMessage());
                $this->data['message'] = Lang::get('messages.image_upload_fail');
                $this->utilObj->renderJson('error', $this->data);
                return false;
            }
            
        }
        
        
    }

    private function validateVideoUpload($file){
        
        $mime = $file->getMimeType();
        echo $mime;
        if($mime == "video/x-flv" || 
            $mime == "video/mp4" || 
            $mime == "application/x-mpegURL" || 
            $mime == "video/MP2T" || 
            $mime == "video/3gpp" || 
            $mime == "video/quicktime" || 
            $mime == "video/x-msvideo" || 
            $mime == "video/x-ms-wmv"){
                return true;
        } else{
            return false;   
        }
    }
}
