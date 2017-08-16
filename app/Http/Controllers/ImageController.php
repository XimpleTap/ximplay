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
        $postData = $request->all();
        $endDate = $postData['endDate'];
        $endDate = Carbon::createFromFormat('m/d/Y', $endDate);
        $endDate = $endDate->format('Y-m-d');
        $destinationPath = config('app.ADS_UPLOAD_DIR');
        $viewData = [];

        foreach(Input::file('file') as $file){
            try{
                $validateImage = $this->validateImageUpload($file);
                if($validateImage){
                    $imageName = $this->setFilename('ads');
                    $fileExtension = $file->getClientOriginalExtension();
                    $destinationPath = config('app.ADS_UPLOAD_DIR');
                    $filename = $this->removeWhiteSpace($imageName);
                    $filename = $filename.".".$fileExtension;
                    $file->move($destinationPath,$filename);  
                    $adModelInstance = new Ad();
                    $dataToSave = array(
                        'promo_end'=>$endDate,
                        'image_path'=>$destinationPath.$filename
                    );
                    $status = $adModelInstance->saveAds($dataToSave);  
                    array_push($viewData,$imageName);
                }
            } catch (Exception $e) {

                Log::error("AppImage::adsUpload()  " . $e->getMessage());
                $this->data['message'] = Lang::get('messages.image_upload_fail');
                $this->utilObj->renderJson('error', $this->data);
                return false;
            }
        }
        return view('ads.success',array('data'=>$viewData));
    
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
        $postData = $request->all();
        $endDate = $postData['endDate'];
        $endDate = Carbon::createFromFormat('m/d/Y', $endDate);
        $endDate = $endDate->format('Y-m-d');
        $destinationPath = config('app.PROMOS_UPLOAD_DIR');
        $viewData = [];
        
        
        foreach(Input::file('file') as $file){
            try{
                $validateImage = $this->validateImageUpload($file);
                if($validateImage){
                    $imageName = $this->setFilename('promos');
                    $fileExtension = $file->getClientOriginalExtension();
                    $destinationPath = config('app.PROMOS_UPLOAD_DIR');
                    $filename = $this->removeWhiteSpace($imageName);
                    $filename = $filename.".".$fileExtension;
                    $file->move($destinationPath,$filename);  
                    $promoModelInstance = new Promo();
                    $dataToSave = array(
                        'promo_end'=>$endDate,
                        'image_path'=>$destinationPath.$filename
                    );
                    $status = $promoModelInstance->savePromo($dataToSave);
                    array_push($viewData,$imageName);
                }
                
                
            } catch (Exception $e) {

                Log::error("AppImage::promosUpload()  " . $e->getMessage());
                $this->data['message'] = Lang::get('messages.image_upload_fail');
                $this->utilObj->renderJson('error', $this->data);
                return false;
            }
        }
        
        return view('promos.success',array('data'=>$viewData));
        
        
    }

    public function adsList(){
        $adModelInstance = new Ad();
        $adDbData = $adModelInstance->fetchAds();
        return view('ads.index',array('data'=>$adDbData));
    }

    public function promosList(){
        $promoModelInstance = new Promo();
        $promoDbData = $promoModelInstance->fetchPromos();
        
    }


    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }

    private function setFilename($_category){
        switch($_category){
            case 'promos':
                $promoModelInstance = new Promo();
                $promosCount = $promoModelInstance->getCurrentCount();
                $imageFilename = $promosCount + 1;
            break;

            case 'ads':
                $adModelInstance = new Ad();
                $adsCount = $adModelInstance->getCurrentCount();
                $imageFilename = $adsCount + 1;
            break;
        }
        return $imageFilename;
    }
}
