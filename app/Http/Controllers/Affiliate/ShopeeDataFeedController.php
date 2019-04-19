<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopeeDataFeedController extends Controller
{
    public function dataFeed(){
        return view('affiliate.datafeed.index');
    }
}
