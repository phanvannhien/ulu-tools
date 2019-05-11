<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignLink extends Model
{

    public function campaign(){
        return $this->belongsTo( Campaign::class, 'campaign_id','campaign_id' );
    }

    public function getBanner( $banner_name ){

        return asset('storage/'.$banner_name );
    }
}
