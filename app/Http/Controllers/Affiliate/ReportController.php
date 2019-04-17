<?php

namespace App\Http\Controllers\Affiliate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Session;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
class ReportController extends Controller
{
    public function report(Request $request){

        $sessionId = Session::get('affiliate')->getSessionId();
        $client = new Client();

        $perPage = 100;
        $page = $request->page ? $request->page : 1;
        $offset = ( $page-1 ) * $perPage;

        $columns = [
            ['id'],
            ['commission'],
            ['totalcost'],
            ['fixedcost'],
            ['t_orderid'],
            ['productid'],
            ['dateinserted'],
            ['name'],
            ['rtype'],
            ['tier'],
            ['commissionTypeName'],
            ['rstatus'],
            ['merchantnote'],
            ['channel'],
        ];

        $arrQuery = [
            'C' => 'Gpf_Rpc_Server',
            'M' => 'run',
            'requests' => [
                [
                    'C' => 'Pap_Affiliates_Reports_TransactionsGrid',
                    'M' => 'getRows',
                    'sort_col' => 'dateinserted',
                    'sort_asc' => false,
                    'offset' => $offset,
                    'limit' => $perPage,
                    'columns' => $columns,
                ]
            ],
            'S' =>  $sessionId,
        ];

        $queryString = 'D='.json_encode($arrQuery);

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

        return view('affiliate.reports.commission', compact('data'));
    }
}
