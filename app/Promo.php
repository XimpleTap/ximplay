<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promo extends Model
{
    protected $table = 'advertiser_promo';
    
    public $timestamps = false;

    public function savePromo($data){
       $promoInstance = new Promo();
       $promoInstance->image_path = $data['image_path'];
       $promoInstance->promo_end = $data['promo_end'];
       $status = $promoInstance->save();
       return $status;
    }

    private function removeWhiteSpace($str){
        return preg_replace('/\s+/', '', $str);
    }

    public function fetchPromos(){
        return DB::table('advertiser_promo')->get();
    }
}
        