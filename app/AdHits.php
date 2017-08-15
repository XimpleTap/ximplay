<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdHits extends Model
{
    protected $table = 'ad_hits';
    public $timestamps = false;

    public function getAdHits(){
        $adHits = AdHits::all();
        return $adHits->toArray();
    }
}
