<?php

namespace App\Models\Affiliate;

use App\Models\Affiliate;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;

class AffiliateCampaign extends Model
{

    protected $fillable = [
        'userid',
        'campaign_id',
        'status',
    ];


    public function affiliate(){
        return $this->belongsTo(Affiliate::class, 'userid','userid')
            ->select('full_name','email','phone','userid');
    }

    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id','id')
            ->select('campaign_name','campaign_id');
    }

}
