<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;

use App\Http\Filters\AffiliateFilter;
use App\Models\Affiliate;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;

use Validator;

use GuzzleHttp\Client;


class AffiliateController extends Controller
{

    public function dashboard()
    {
        $queryTrendsReport = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReportWidget",+"M":"load",+"isInitRequest":"Y",+"filterType":"trends_report",+"filters":[["rstatus","IN","A"],["datetime","DP","L30D"]]},{"C":"Pap_Stats_TransactionTypes",+"M":"getActionTypes",+"filters":[["rstatus","IN","A"],["datetime","DP","L30D"]]}],+"S":"67mk8azohb8387932p8jnp0ohz2mpxye"}';


        $sessionId = Session::get('affiliate')->getSessionId();
        $client = new Client();
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryTrendsReport,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);



        $queryTrendsReportAction = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReportActionWidget",+"M":"load",+"filters":[["action","E","S"],["rstatus","IN","A"],["datetime","DP","L30D"]]}],+"S":"67mk8azohb8387932p8jnp0ohz2mpxye"}';
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryTrendsReportAction,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $dataReportAction = $response->getBody()->getContents();
        $dataReportAction = json_decode($dataReportAction);


        $queryChart = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Reports_TrendsReport",+"M":"loadData",+"isInitRequest":"N",+"filterType":"trends_report",+"filters":[["datetime","DP","L30D"],["rpc","=","Y"],["groupBy","=","day"],["dataType1","=","saleCount"],["dataType2","=","_item_none_"],["rstatus","IN","A"]]}],+"S":"67mk8azohb8387932p8jnp0ohz2mpxye"}';
        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryChart,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $dataChart = $response->getBody()->getContents();
        $dataChart = json_decode($dataChart);


//        dd($data);

        return view('affiliate.dashboard', compact('data','dataReportAction','dataChart'));
    }


    public function profile(){
        return view('affiliate.auth.profile');
    }


}
