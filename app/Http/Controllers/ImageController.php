<?php

namespace App\Http\Controllers;


use App\Promo;
use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ImageController extends Controller
{
    public function adsUploadForm(){
        return view('ads.uploadform');
    }

    public function adsUpload(Request $request){
        $validateImage = $this->validateImageUpload(Input::file('file'));
        if($validateImage){

            try{
                $file = $request->file('file');
                $destinationPath = config('app.ADS_UPLOAD_DIR');
                $filename = $this->removeWhiteSpace($file->getClientOriginalName());
                $file->move($destinationPath,$filename);  
                $adModelInstance = new Ad();
                $status = $adModelInstance->saveAds($request->all());  
                 
            } catch (Exception $e) {

                Log::error("AppImage::adsUpload()  " . $e->getMessage());
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

    public function promosUploadForm(){
        return view('promos.uploadform');
    }

    public function promosUpload(Request $request){
        $validateImage = $this->validateImageUpload(Input::file('file'));
        if($validateImage){

            try{
                $file = $request->file('file');
                $destinationPath = config('app.PROMOS_UPLOAD_DIR');
                $filename = $this->removeWhiteSpace($file->getClientOriginalName());
                $file->move($destinationPath,$filename);  
                $promoModelInstance = new Promo();
                $status = $promoModelInstance->savePromo($request->all());
                echo $status;
                 
            } catch (Exception $e) {

                Log::error("AppImage::promosUpload()  " . $e->getMessage());
                $this->data['message'] = Lang::get('messages.image_upload_fail');
                $this->utilObj->renderJson('error', $this->data);
                return false;
            }
        }
    }


    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }
}
