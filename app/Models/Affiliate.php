<?php

namespace App\Models;

use App\Filters\Filterable;
use App\Models\Affiliate\UserBanks;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Affiliate extends Authenticatable
{
    //
    use Notifiable;
    use Filterable;

    protected $primaryKey = 'id';
//    public $incrementing = false;

    public $fillable = [
        'userid',
        'username',
        'password',
        'pap_password',
        'dob',
        'agreement',
        'avatar',
        'full_name',
        'company',
        'website',
        'address',
        'matp',
        'maqh',
        'status',
        'locked',
        'phone',
        'email',
    ];


    public function banks(){
        return $this->hasMany( UserBanks::class, 'user_id' );
    }
}
