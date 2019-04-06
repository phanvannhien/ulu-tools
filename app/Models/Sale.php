<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

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
    ];


}
