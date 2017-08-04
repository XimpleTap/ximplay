<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    protected $table = 'advertiser_promo';
    
    public $timestamps = false;

    public function savePromo($data){
       $destinationPath = config('app.PROMOS_UPLOAD_DIR');
       $promoInstance = new Promo();
       $filename = $this->removeWhiteSpace($data['file']->getClientOriginalName());
       
       $date = Carbon::createFromFormat('m/d/Y', $data['endDate']);
       $usableDate = $date->format('Y-m-d');
       dump($usableDate);


       $promoInstance->image_path = $destinationPath.$filename;
       $promoInstance->promo_end = $usableDate;
       $status = $promoInstance->save();
       return $status;


    }

    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }


}
        