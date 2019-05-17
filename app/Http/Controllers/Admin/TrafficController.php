<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServicesUlu\AdminUlu;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use App\Models\Affiliate;
use App\Models\Campaign;
use Illuminate\Support\Arr;

class TrafficController extends Controller
{
    public function index(Request $request, AdminUlu $ulu){

        $perPage = 100;

        if( $request->has('action') && $request->get('action') == 'download' ){
            $perPage = 20000;
        }


        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        if( $request->has('created_at') ){
            $arrDate = explode( '-', $request->get('created_at') );
            $startDate = str_replace('/','-',trim($arrDate[0]));
            $endDate = str_replace('/','-',trim($arrDate[1]));
            $queryDate = $startDate.','.$endDate;
        }

        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'affiliate_id' => $request->has('affiliate_id') ? $request->input('affiliate_id') : '',
            'campaign_id' => $request->has('campaign_id') ? $request->input('campaign_id') : '',
            'created_at' => isset($queryDate) ? $queryDate : ''
        ];


        $conversions = $ulu->getTraffic( $params );
//        dd($conversions);

        $chartData = [];
        foreach ( $conversions->payloads->summary as $item ){

            $month = ($item->_id->month < 10) ? '0'.$item->_id->month : $item->_id->month;
            $day = ($item->_id->day < 10) ? '0'.$item->_id->day : $item->_id->day;

            array_push($chartData, [
                'date' => $item->_id->year.'-'.$month.'-'.$day,
                'value' => $item->count
            ]);

        }

        $chartData = array_values( Arr::sort($chartData, function ($value) {
            return $value['date'];
        }));


        $data = new Paginator(
            $conversions->payloads->data,
            $conversions->payloads->total_records,
            $perPage,
            $page, ['path'  => $request->url(), 'query' => $request->query()]);


        $dataCampaigns = Campaign::select('campaigns.campaign_id', 'campaign_name')
            ->get()->toArray();

        $campaigns = array();
        foreach ($dataCampaigns as $campaign){
            $campaigns[$campaign['campaign_id']] = $campaign['campaign_name'];
        }

        $dataAff = Affiliate::select('userid', 'full_name')
            ->get()->toArray();

        $affiliates = array();
        foreach ($dataAff as $aff){
            $affiliates[$aff['userid']] = $aff['full_name'];
        }


        if( $request->has('action') && $request->get('action') == 'download' ){
            return Excel::download( new TransactionExport(  $conversions->payloads->data, $campaigns, $affiliates ),
                'conversion'. now() .'.xlsx' );
        }

        return view('admin.traffic.index',  compact('data', 'conversions','campaigns','affiliates', 'chartData' ));
    }

}
