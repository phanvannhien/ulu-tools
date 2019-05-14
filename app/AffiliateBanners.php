<?php

namespace App;

use App\Models\Affiliate;
use Illuminate\Database\Eloquent\Model;

class AffiliateBanners extends Model
{
    protected $fillable = [
        'banner_id',
        'affiliate_id'
    ];

    public function affiliate(){
        return $this->belongsTo( Affiliate::class, 'affiliate_id', 'userid' );
    }

}
