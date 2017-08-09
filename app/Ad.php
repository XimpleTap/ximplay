<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Ad extends Model
{
    public $table = 'ads';
    
    public $timestamps = false;

    public function saveAds($data){
       $adInstance = new Ad();
       $adInstance->image_path = $data['image_path'];
       $adInstance->ad_end = $data['promo_end'];
       $status = $adInstance->save();
       return $status;
    }

    public function fetchAds(){
        return DB::table('ads')->get();
    }

    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }
}
