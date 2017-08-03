<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function uploadForm(){
        return view('image.uploadform');
    }

    public function upload(Request $request){
        $validateImage = $this->validateVideoUpload(Input::file('file'));
        if($validateImage){

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

    public function validateImageUpload($file){
        
        $mime = $file->getMimeType();

        if($mime == "image/jpeg" || $mime == "image/png" ){
            return true;
        } else{
            return false;   
        }
    }
}
