<?php
namespace App\APIs;

use Session;
use GuzzleHttp\Client;

class PAP{

    public $session;
    public $client;
    public $url;
    public $headers;


    public function __construct(){
 
        $this->session = session()->get('affiliate')->getSessionId();
        $this->client = new Client();
        $this->url =  'https://account.ulu.vn/scripts/server.php';
        $this->headers = [
            "Access-Control-Allow-Credentials"=> true,
            "Access-Control-Allow-Origin" => "*",
            "content-type" => "application/x-www-form-urlencoded"
        ];
    }

    public function getCampaign()
    {
        $data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Promo_CampaignsGrid",+"M":"getRows",+"offset":0,+"limit":100,+"columns":[["id"],["id"],["name"],["description"],["logourl"],["banners"],["longdescriptionexists"],["commissionsdetails"],["rstatus"],["commissionsexist"],["affstatus"]]}],+"S":"'.$this->session.'"}';

        $response =  $this->client->request('POST', $this->url , [
            'body' => $data,
            'headers' => $this->headers
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        
        if( count( $data ) ){
            return $data;
        }
        return false;

    }


    public function getAllBanners(){
        $query = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Promo_CampaignsGrid",+"M":"getRows",+"offset":0,+"limit":100,+"columns":[["id"],["id"],["name"],["description"],["logourl"],["banners"],["longdescriptionexists"],["commissionsdetails"],["rstatus"],["commissionsexist"],["affstatus"]]}],+"S":"7cy8w23yafiwvmfiabv7fw8lmom8hxtf"}';
    }

    public function getAffiliateProfileFormData(){
        $data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Gpf_Db_Table_FormFields",+"M":"getTranslatedFields",+"formId":"affiliateForm",+"status":"M,O,R,S,W,P"},{"C":"Pap_Affiliates_Profile_PersonalDetailsForm",+"M":"load",+"fields":[["name","value"],["Id",""]]}],+"S":"'.$this->session.'"}';
        $response =  $this->client->request('POST', $this->url , [
            'body' => $data,
            'headers' => $this->headers
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        
        if( count( $data ) ){
            return $data;
        }
        return false;
        
    }

    public function updateAffiliateProfile(){
        $data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Profile_PersonalDetailsForm",+"M":"save",+"fields":[["name","value"],["Id",""],["username","phanvannhien@gmail.com"],["rpassword","Vannhien@88"],["firstname","Test"],["lastname","Account"],["timezoneOffset","25200"],["useCustomTimezone","N"],["lang","Tiếng+Việt+(Vietnamese)+[vi]"],["photo",""],["data1","nhienphan.com"],["data2",""],["data3","Go+Vap+"],["data4","TP+Hồ+Chí+Minh"],["data8","0902181852"]]}],+"S":"w96o2luln1w9ydh04erdpe1tu17qvl0v"}';
        
    }


    public function changeAffiliatePassword( $userId, $password ){

        $session = new Pap_Api_Session( config('ulu.server') );
        if(! $session->login( config('ulu.owner')['email'] ,  config('ulu.owner')['password'] )) {
            return false;
        }

        $affiliate = new Pap_Api_Affiliate($session);
        $affiliate->setUserid( $userId );
        $affiliate->setPassword($password);
        try {
            $affiliate->save();
            return true;
        } catch (Exception $e) {

        }
        return false;

    }

    public function getConversion( $page, $filters ){
        $sessionId = Session::get('affiliate')->getSessionId();
        $client = new Client();

        $perPage = 100;

        $offset = ( $page-1 ) * $perPage;

        $filters = [];

//        if( $request->has('t_orderid') && $request->input('t_orderid') != '' ){
//            $filters[] = ["orderId","L", $request->input('t_orderid') ];
//        }
//        if( $request->has('dateinserted') && $request->input('dateinserted') != '' ){
//            $filters[] = ["dateinserted","DP", $request->input('dateinserted') ];
//        }
//
//        if( $request->has('payoutstatus') && $request->input('payoutstatus') != '' ){
//            $filters[] = ["payoutstatus","IN", $request->input('payoutstatus') ];
//        }



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

    }

}