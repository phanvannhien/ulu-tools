<?php

namespace App\Models;

use App\Filters\Filterable;
use App\Models\Affiliate\UserBanks;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPasswordNotification;

class Affiliate extends Authenticatable
{
    //
    use Notifiable;
    use Filterable;

    protected $primaryKey = 'id';
//    public $incrementing = false;

    public $fillable = [
        'userid',
        'refid',
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


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }


    public function banks(){
        return $this->hasMany( UserBanks::class, 'user_id' );
    }

    public function sales(){
        return $this->hasMany( Sale::class, 'userid','userid' );
    }

    public function campaigns(){
        return $this->belongsToMany(
            Campaign::class,
            'affiliate_campaigns',
            'userid',
            'campaign_id',
            'userid',
            'id'
            )
            ->where('campaigns.status', 1);
    }


    public function isRegisterdCampain( $campaign_id ){
        $isReg = $this
            ->campaigns()
            ->where('affiliate_campaigns.campaign_id', $campaign_id)
            ->select('affiliate_campaigns.userid','affiliate_campaigns.campaign_id', 'affiliate_campaigns.status' )->first();
        if( $isReg )
            return $isReg;
        return false;
    }



}
