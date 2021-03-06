<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Mongo\ClickTracking;
use App\Models\Sale;
use App\ServicesUlu\GoUlu;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;
use MongoDB\Driver\Exception\ConnectionException;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Filters\TransactionFilter;

use Excel;
use App\Models\Affiliate;
use Str;

use App\Exports\TransactionExport;

use Illuminate\Support\Arr;


class ReportController extends Controller
{
    public function report(Request $request, TransactionFilter $filter,  GoUlu $ulu){

        $perPage = 100;

        if( $request->has('action') && $request->get('action') == 'download' ){
            $perPage = 5000;
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
            'order_id' => $request->has('order_id') ? $request->input('order_id') : '',
            'campaign_id' => $request->has('campaign_id') ? $request->input('campaign_id') : '',
            'created_at' => isset($queryDate) ? $queryDate : ''
        ];

        try{
            $conversions = $ulu->getConversions( auth()->user()->jwt_token, $params );

            $data = new Paginator(
                $conversions->payloads->data,
                $conversions->payloads->total_records,
                $perPage,
                $page, ['path'  => $request->url(), 'query' => $request->query()]);

            $dataAff = Affiliate::select('userid', 'full_name')
                ->get()->toArray();

            $affiliates = array();
            foreach ($dataAff as $aff){
                $affiliates[$aff['userid']] = $aff['full_name'];
            }


            $dataCampaigns = auth()->user()
                ->campaigns()
                ->select('campaigns.campaign_id', 'campaign_name')
                ->get()->toArray();

            $campaigns = array();
            foreach ($dataCampaigns as $campaign){
                $campaigns[$campaign['campaign_id']] = $campaign['campaign_name'];
            }

            if( $request->has('action') && $request->get('action') == 'download' ){

                return Excel::download( new TransactionExport(  $conversions->payloads->data, $campaigns, $affiliates ),
                    'conversion'. time() .'.xlsx' );
            }

            return view('affiliate.reports.commission', compact('data', 'conversions','campaigns'));

        }catch (ConnectException $e){
            throw ValidationException::withMessages(['Có lỗi xảy ra, không thể thực hiện']);
        }




    }


    public function reportClick(Request $request, GoUlu $ulu){
        $perPage = 100;
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
            'campaign_id' => $request->has('campaign_id') ? $request->input('campaign_id') : '',
            'created_at' => isset($queryDate) ? $queryDate : '',
            'type' => $request->has('type') ? $request->get('type') : '',
        ];

        try{
            $clicks = $ulu->getClickTracking( auth()->user()->jwt_token, $params );

            $chartData = [];
            foreach ( $clicks->payloads->summary as $item ){

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
                $clicks->payloads->data,
                $clicks->payloads->count,
                $perPage,
                $page, ['path'  => $request->url(), 'query' => $request->query()]);

            $dataCampaigns = auth()->user()
                ->campaigns()
                ->select('campaigns.campaign_id', 'campaign_name')
                ->get()->toArray();

            $campaigns = array();
            foreach ($dataCampaigns as $campaign){
                $campaigns[$campaign['campaign_id']] = $campaign['campaign_name'];
            }
            return view('affiliate.reports.click', compact('data','campaigns','chartData'));
        }catch (ConnectException $e){
            throw ValidationException::withMessages(['Có lỗi xảy ra, không thể thực hiện']);
        }
    }


}
