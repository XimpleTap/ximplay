<?php

namespace App\Http\Controllers;


use App\Promo;
use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;


class ImageController extends Controller
{
    public function adsUploadForm(){
        return view('ads.uploadform');
    }

    public function adsUpload(Request $request){
        //TODO: enter validation method call here
        //$validateImage = $this->validateImageUpload(Input::file('file'));
        $validateImage = true;
        $postData = $request->all();
        $endDate = $postData['endDate'];
        $endDate = Carbon::createFromFormat('m/d/Y', $endDate);
        $endDate = $endDate->format('Y-m-d');
        $destinationPath = config('app.ADS_UPLOAD_DIR');
        if($validateImage){
            foreach(Input::file('file') as $file){
                try{
                    $imageName = $file->getClientOriginalName();
                    $destinationPath = config('app.ADS_UPLOAD_DIR');
                    $filename = $this->removeWhiteSpace($imageName);
                    $file->move($destinationPath,$filename);  
                    $adModelInstance = new Ad();
                    $dataToSave = array(
                        'promo_end'=>$endDate,
                        'image_path'=>$destinationPath.$filename
                    );
                    $status = $adModelInstance->saveAds($dataToSave);  
                    echo $status;
                    
                } catch (Exception $e) {

                    Log::error("AppImage::adsUpload()  " . $e->getMessage());
                    $this->data['message'] = Lang::get('messages.image_upload_fail');
                    $this->utilObj->renderJson('error', $this->data);
                    return false;
                }
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
        //TODO: enter validation method call here
        //$validateImage = $this->validateImageUpload(Input::file('file'));
        $validateImage = true;
        $postData = $request->all();
        $endDate = $postData['endDate'];
        $endDate = Carbon::createFromFormat('m/d/Y', $endDate);
        $endDate = $endDate->format('Y-m-d');
        $destinationPath = config('app.PROMOS_UPLOAD_DIR');
        
        if($validateImage){
            foreach(Input::file('file') as $file){
                try{
                    $imageName = $file->getClientOriginalName();
                    $destinationPath = config('app.PROMOS_UPLOAD_DIR');
                    $filename = $this->removeWhiteSpace($imageName);
                    $file->move($destinationPath,$filename);  
                    $promoModelInstance = new Promo();
                    $dataToSave = array(
                        'promo_end'=>$endDate,
                        'image_path'=>$destinationPath.$filename
                    );
                    $status = $promoModelInstance->savePromo($dataToSave);
                    echo $status;
                } catch (Exception $e) {

                    Log::error("AppImage::promosUpload()  " . $e->getMessage());
                    $this->data['message'] = Lang::get('messages.image_upload_fail');
                    $this->utilObj->renderJson('error', $this->data);
                    return false;
                }
            }
            
            
            
        }
    }


    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }
}
