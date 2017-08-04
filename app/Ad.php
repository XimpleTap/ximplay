<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ad extends Model
{
    public $table = 'ads';
    
    public $timestamps = false;

    public function saveAds($data){
        
       $destinationPath = config('app.ADS_UPLOAD_DIR');
       $promoInstance = new Ad();
       $filename = $this->removeWhiteSpace($data['file']->getClientOriginalName());
       
       $date = Carbon::createFromFormat('m/d/Y', $data['endDate']);
       $usableDate = $date->format('Y-m-d');

       $promoInstance->image_path = $destinationPath.$filename;
       $promoInstance->ad_end = $usableDate;
       $status = $promoInstance->save();
       return $status;


    }

    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }
}
