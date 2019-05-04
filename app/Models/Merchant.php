<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{

    public function getLogo(){
        return asset('storage/'.$this->logo );
    }

}
