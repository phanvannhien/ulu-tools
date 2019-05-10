<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\CampaignLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignLinkController extends Controller
{
    public function index(){
        $data = CampaignLink::orderBy('created_at','DESC')->paginate();
        return view('admin.campaign_link.index', compact('data'));
    }

    public function create(){
        $campaigns = Campaign::select('id','campaign_id','campaign_name')->get();
        return view('admin.campaign_link.create', compact('campaigns'));
    }

    public function store(){

    }
}
