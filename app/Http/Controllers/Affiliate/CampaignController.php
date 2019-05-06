<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Affiliate\AffiliateCampaign;
use App\Models\Campaign;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Pap_Api_Session;
use Gpf_Rpc_GridRequest;
use Gpf_Rpc_FormRequest;
use Gpf_Rpc_Request;
use Gpf_Data_Filter;
use Gpf_Rpc_Array;
use Session;

use GuzzleHttp\Client;

class CampaignController extends Controller
{

    public function index(){

    }

    public function getCampaign()
    {
        $campaigns = auth()->user()->campaigns()->get();
        return view('affiliate.campaign.index', compact('campaigns'));
    }


    public function getCampaignDetail( $id ){
        $campaign = Campaign::findOrFail($id);
        return view('affiliate.campaign.show', compact( 'campaign'));

    }

    // Method POST
    public function registerCampaign(Request $request, $id ){
        if( $request->ajax() && $request->isMethod('POST') ){
            $register = AffiliateCampaign::firstOrCreate([
                'userid' => auth()->user()->userid,
                'campaign_id' => $id
            ]);

            if($register)

                return response()->json(['success' => true ]);
            return response()->json(['success' => false, 'message' => 'Đăng ký lỗi, vui lòng thử lại' ]);
        }
    }

}
