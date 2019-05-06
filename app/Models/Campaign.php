<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    //

    public function merchant(){
        return $this->belongsTo( Merchant::class, 'merchant_id','account_id' );
    }


}
