<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Campaign;
use Illuminate\Support\Str;
use Validator;

class CampaignController extends Controller
{
    public function index(){
        $data =  Campaign::paginate();
        return view('admin.campaign.index', compact('data'));
    }

    public function create(){
        return view('admin.campaign.create');
    }

    public function store(Request $request){
        $rules = [
            'merchant_id' => 'required',
            'campaign_name' => 'required|string',
            'commission_rate' => 'required|integer',
            'type' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new Campaign();
        $data->campaign_id = Str::lower(Str::random( 8 ));
        $data->merchant_id = $request->input('merchant_id');
        $data->campaign_name = $request->input('campaign_name');
        $data->commission_rate = $request->input('commission_rate');
        $data->cookie_time = $request->input('cookie_time');
        $data->type = $request->input('type');
        $data->description = $request->input('description');
        $data->fixed_url = $request->input('fixed_url');

        if( $data->save() ){
            return redirect()
                ->route( 'campaign.edit', $data->id )
                ->with('status',  'Success' );
        }
        return back()->with('status', 'Fail');
    }

    public function edit($id){
        $data = Campaign::findOrFail($id);
        return view('admin.campaign.edit', compact('data') );
    }

    public function update(Request $request, $id){

        $rules = [];
        $data = Campaign::findOrFail($id);
        $rules = [
            'merchant_id' => 'required',
            'campaign_name' => 'required|string',
            'commission_rate' => 'required|integer',
            'type' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        
        $data->merchant_id = $request->input('merchant_id');
        $data->campaign_name = $request->input('campaign_name');
        $data->commission_rate = $request->input('commission_rate');
        $data->cookie_time = $request->input('cookie_time');
        $data->type = $request->input('type');
        $data->description = $request->input('description');
        $data->fixed_url = $request->input('fixed_url');
        if( $data->save() ){
            return redirect()
                ->route( 'campaign.edit', $data->id )
                ->with('status',  'Success' );
        }
        return back()->with('status', 'Fail');
    }


    public function destroy($id){

        $data = Campaign::findOrFail($id);
        $data->delete();
        return redirect()
            ->route( 'campaign.index' )
            ->with('status',  'Delete success' );

    }
}
