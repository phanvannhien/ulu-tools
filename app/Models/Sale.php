<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use Filterable;

    protected $primaryKey = 't_orderid';
    public $incrementing = false;

    protected $fillable = [
        't_orderid',
        'userid',
        'campaignid',
        'productid',
        'accountid',
        'commission',
        'totalcost',
        'rstatus',
        'data1',
        'data2',
        'conversion_date',
        'bannerid',
        'visitorid',
    ];


    public function affiliate(){
        return $this->belongsTo( Affiliate::class, 'userid','refid' );
    }

    public function advertiser(){
        return $this->belongsTo( Merchant::class, 'accountid','account_id' );
    }


}
