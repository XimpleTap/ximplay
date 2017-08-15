<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PromoHits extends Model
{
    protected $table = 'advertiser_promo_hits';
    public $timestamps = false;

    public function getPromoHits(){
        $promoHits = PromoHits::all();
        return $promoHits->toArray();
    }
}
