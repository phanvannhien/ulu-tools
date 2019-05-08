<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Mongo\ClickTracking;
use App\Models\Sale;
use App\Services\GoUlu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Filters\TransactionFilter;

use Excel;
use Str;

use App\Exports\TransactionExport;

class ReportController extends Controller
{
    public function report(Request $request, TransactionFilter $filter,  GoUlu $ulu){

        $perPage = 100;
        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'campaign_id' => $request->has('campaign_id') ? $request->get('campaign_id') : '',

        ];


        $conversions = $ulu->getConversions( auth()->user()->jwt_token, $params );

        $data = new Paginator(
            $conversions->payloads->data,
            $conversions->payloads->total_records,
            $perPage,
            $page, ['path'  => $request->url(), 'query' => $request->query()]);


        return view('affiliate.reports.commission', compact('data', 'conversions'));


    }


    public function reportClick(Request $request, GoUlu $ulu){
        $perPage = 100;
        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        $params = [
            'page' => $page,
            'per_page' => $perPage,
            'campaign_id' => $request->has('campaign_id') ? $request->input('campaign_id') : '',
        ];

        $clicks = $ulu->getClickTracking( auth()->user()->jwt_token, $params );


        $data = new Paginator(
            $clicks->payloads->data,
            $clicks->payloads->count,
            $perPage,
            $page, ['path'  => $request->url(), 'query' => $request->query()]);

        return view('affiliate.reports.click', compact('data'));
    }


}
