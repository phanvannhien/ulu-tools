<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Affiliate\AffiliateCampaign;

class Campaign extends Model
{
    //

    public function merchant(){
        return $this->belongsTo( Merchant::class, 'merchant_id','account_id' );
    }

    public function publishers(){
        return $this->hasMany( AffiliateCampaign::class, 'campaign_id','id' );
    }

}
