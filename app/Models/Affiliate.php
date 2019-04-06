<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    //

    protected $primaryKey = 'id';
    public $incrementing = false;

    public $fillable = [
        'id',
        'refid',
        'userid',
        'username',
        'firstname',
        'lastname',
        'rstatus',
        'parentuserid',
        'dateinserted',
        'commission_rate',
        'rstatus',
        'data8',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
