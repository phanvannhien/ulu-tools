<?php

namespace App\Models\Mongo;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ClickTracking extends Eloquent
{


    protected $connection = 'mongodb';
    protected $collection = 'tracking';

}
