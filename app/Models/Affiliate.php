<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    //

    use Filterable;

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
