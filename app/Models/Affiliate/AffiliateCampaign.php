<?php

namespace App\Models\Affiliate;

use Illuminate\Database\Eloquent\Model;

class AffiliateCampaign extends Model
{

    protected $fillable = [
        'userid',
        'campaign_id',
        'status',
    ];

}
