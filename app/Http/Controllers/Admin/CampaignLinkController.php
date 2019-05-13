<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\CampaignLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


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

    public function store( Request $request ){
        $rules = [
            'campaign_id' => 'required',
            'link' => 'required|string|active_url',
            'date_time' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new CampaignLink();
        $data->campaign_id = $request->input('campaign_id');
        $data->link = $request->input('link');
        $data->link_title = $request->input('link_title');

        $arrDate = explode( '-', $request->get('date_time') );
        $data->start_date = str_replace('/','-',trim($arrDate[0]));
        $data->end_date = str_replace('/','-',trim($arrDate[1]));

        $arraySizeImages = [
            'banner_240_400',
            'banner_160_600',
            'banner_320_50',
            'banner_336_280',
            'banner_728_90',
            'banner_300_250',
            'banner_468_60',
            'banner_300_600',
        ];

        foreach ( $arraySizeImages as $banner ){
            if( $request->hasFile($banner ) ){
                $path = $request->file($banner)->storeAs('banner', time().$banner.'.jpg' );
                $data->$banner = $path;
            }
        }



        if( $data->save() ){
            return redirect()
                ->route( 'campaign_link.edit', $data->id )
                ->with('status',  'Success' );
        }

        return back()->with('status', 'Fail');
    }

    public function edit($id){
        $campaigns = Campaign::select('id','campaign_id','campaign_name')->get();
        $data = CampaignLink::findOrFail($id);
        return view('admin.campaign_link.edit', compact('data','campaigns'));
    }

    public function update( Request $request, $id ){
        $rules = [
            'campaign_id' => 'required',
            'link' => 'required|string|active_url',
            'date_time' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = CampaignLink::findOrFail($id);
        $data->campaign_id = $request->input('campaign_id');
        $data->link = $request->input('link');
        $data->link_title = $request->input('link_title');

        $arrDate = explode( '-', $request->get('date_time') );
        $data->start_date = str_replace('/','-',trim($arrDate[0]));
        $data->end_date = str_replace('/','-',trim($arrDate[1]));

        $arraySizeImages = [
            'banner_240_400',
            'banner_160_600',
            'banner_320_50',
            'banner_336_280',
            'banner_728_90',
            'banner_300_250',
            'banner_468_60',
            'banner_300_600',
        ];

        foreach ( $arraySizeImages as $banner ){
            if( $request->hasFile($banner ) ){
                $path = $request->file($banner)->storeAs('banner', time().'_'.$banner.'.jpg'  );
                $data->$banner = $path;
            }
        }


        if( $data->save() ){
            return redirect()
                ->route( 'campaign_link.edit', $data->id )
                ->with('status',  'Success' );
        }

        return back()->with('status', 'Fail');
    }

}
