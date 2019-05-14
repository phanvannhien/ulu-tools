<?php
namespace App\Http\Controllers\Admin;
use App\AffiliateBanners;
use App\Http\Controllers\Controller;


use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;

use Validator;
use Hash;

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

    public function changePassword( $id ){
        $affiliate = Affiliate::findOrFail( $id );
        return view('admin.affiliate.change_password', compact('affiliate'));
    }

    public function changePasswordSave( Request $request, $id ){

        $user = Affiliate::findOrFail( $id );
        $rules['password'] = 'required|min:6|max:100|confirmed';

        $validator = Validator::make($request->all(), $rules,[
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Vui lòng nhập mật khẩu tối đa 100 kí tự',
            'password.confirmed' => 'Nhắc lại mật khẩu không trùng khớp',
        ]);

        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $new_password = $request->input('password');
        $user->password = Hash::make($new_password);


        if($user->save()) {
            return back()->with(['status' => 'Cập nhật thành công']);
        }

        return back()->with(['status' => 'Cập nhật lỗi']);

    }

    public function addAffiliateBanner(Request $request, $banner_id ){


        $affiliate = Affiliate::findOrFail( $request->affiliate_id );

        $created = AffiliateBanners::firstOrCreate(
            [
                'banner_id' => $banner_id,
                'affiliate_id' =>  $affiliate->userid
            ],
            [
                'banner_id' => $banner_id,
                'affiliate_id' =>  $affiliate->userid
            ]
        );
        if($created){
            return back()->with('status','Success');
        }

        return back()->with('warning','Fail');
    }

    public function removeAffiliateBanner(Request $request, $banner_id ){


        $deleted = AffiliateBanners::where('banner_id',$banner_id )
                ->where('affiliate_id', $request->affiliate_id )
                ->delete();

        if($deleted){
            return back()->with('status','Success');
        }
        return back()->with('warning','Fail');
    }



    // ajax

    public function ajaxGetAffiliate(Request $request){

        if($request->ajax()){
            $query = $request->get('search');
            $banner_id = $request->get('banner_id');

            $affiliatesBanner = AffiliateBanners::where( 'banner_id', $banner_id )->pluck('affiliate_id');

            if( $query != '' ){
                $affiliates = Affiliate::where('full_name','LIKE','%'.$query.'%')
                    ->whereNotIn( 'userid', $affiliatesBanner)
                    ->select('id as id','full_name as text')->get();
                return response()->json( $affiliates );
            }



        }
    }


}
