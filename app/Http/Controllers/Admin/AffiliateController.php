<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;

use Validator;

class AffiliateController extends Controller
{



    public function index( Request $request, AffiliateFilter $filter ){
        $data = Affiliate::filter( $filter )->paginate();
        return view('admin.affiliate.index', [ 'data' => $data ]);
    }

    public function create(){
        return back();
    }

    public function store(Request $request){
        return back();
    }

    public function edit(Affiliate $affiliate){
        return view('admin.affiliate.edit', compact('affiliate') );
    }

    public function update(Request $request, Affiliate $affiliate){
        $rules = [
            'commission_rate' => 'required|integer',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $affiliate->commission_rate = $request->input('commission_rate');


        if( $affiliate->save() ){
            return redirect()
                ->route( 'affiliate.edit', $affiliate->id )
                ->with('status',  'Update success' );
        }
        return back()->with('status', 'Update fail');
    }

    public function destroy(Merchant $merchant){
        return back();
    }

    public function show($id){
        $affiliate = Affiliate::findOrFail( $id );
        $campaigns = $affiliate->campaigns()->select('campaigns.*','affiliate_campaigns.status as register_status')->get();
        return view('admin.affiliate.show', compact('affiliate', 'campaigns'));
    }

    public function approveCampaign(Request $request, $affiliate_id, $campaign_id ){
        $update = Affiliate\AffiliateCampaign::where( 'userid', $affiliate_id )
                ->where('campaign_id', $campaign_id)
                ->update([ 'status' => 1 ]);
        if( $update ){
            return back()->with('status','Success');
        }
        return back()->with('warning','Fail');
    }

}
