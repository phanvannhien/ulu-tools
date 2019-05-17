<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Affiliate;
use App\Models\Affiliate\AffiliateCampaign;
use Illuminate\Http\Request;




class HomeController extends Controller
{
    public function index(){
        $countRegisteredCampaign = AffiliateCampaign::where('status',0)
            ->orderBy('created_at','DESC')->count();

        $totalAffiliates = Affiliate::count();

        return view('admin.index', compact('countRegisteredCampaign', 'totalAffiliates'));

    }
}
