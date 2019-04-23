<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Sale;
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
    public function report(Request $request, TransactionFilter $filter){


        $data = Sale::filter($filter)->where('userid', auth()->user()->refid )->orderBy('conversion_date', 'DESC');

        $total = $data->sum('totalcost');
        $commission_total = $data->sum('commission');

        if( $request->input('action') == 'download' ){
            return Excel::download( new TransactionExport(  $data->get() ), 'conversion'. str_replace('/','-', $request->get('conversion_date') ).'.xlsx' );
        }

        $data = $data->paginate(100);
        return view('affiliate.reports.commission', compact('data', 'total','commission_total'));


    }


    public function reportClick(Request $request){
        $data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_ClicksGrid",+"M":"getRows",+"sort_col":"clickid",+"sort_asc":false,+"offset":0,+"limit":100,+"columns":[["id"],["id"],["clickid"],["banner"],["campaign"],["rtype"],["datetime"],["ip"],["channelname"],["referrerurl"]]}],+"S":"7cy8w23yafiwvmfiabv7fw8lmom8hxtf"}';

        $sessionId = Session::get('affiliate')->getSessionId();
        $client = new Client();

        $perPage = 100;
        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        $filters = [];

        if( $request->has('t_orderid') && $request->input('t_orderid') != '' ){
            $filters[] = ["orderId","L", $request->input('t_orderid') ];
        }

        if( $request->has('datetime') && $request->input('datetime') != '' ){
            $filters[] = ["datetime","DP", $request->input('datetime') ];
        }

        if( $request->has('rtype') && $request->input('rtype') != '' ){
            $filters[] = ["rtype","IN", $request->input('rtype') ];
        }



        $columns = [
            ['id'],
            ['clickid'],
            ['banner'],
            ['campaign'],
            ['rtype'],
            ['datetime'],
            ['ip'],
            ['channelname'],
            ['referrerurl'],

        ];

        $arrQuery = [
            'C' => 'Gpf_Rpc_Server',
            'M' => 'run',
            'requests' => [
                [
                    'C' => 'Pap_Affiliates_Reports_ClicksGrid',
                    'M' => 'getRows',
                    'sort_col' => 'datetime',
                    'sort_asc' => false,
                    'offset' => $offset,
                    'limit' => $perPage,
                    'filters' => $filters,
                    'columns' => $columns,
                ]
            ],
            'S' =>  $sessionId,
        ];

        $queryString = 'D='.json_encode($arrQuery);

        // dd($queryString);

        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryString,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);

        $data = new Paginator($data[0]->rows, $data[0]->count, $perPage, $page, ['path'  => $request->url(), 'query' => $request->query()]);

        return view('affiliate.reports.click', compact('data'));
    }


}
