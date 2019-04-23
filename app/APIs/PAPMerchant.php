<?php
namespace App\APIs;

use Illuminate\Validation\ValidationException;
use Session;
use GuzzleHttp\Client;

use Pap_Api_Session;
use Pap_Api_Affiliate;


class PAPMerchant{

    public $session;
    public $client;
    public $url;
    public $headers;


    public function __construct(){

        $session = new Pap_Api_Session( config('ulu.server') );
        $account = config('ulu.owner');
        if(! $session->login( $account['email'] ,  $account['password'] )) {
            return false;
        }

        $this->session = $session;
        $this->client = new Client();
        $this->url =  'https://account.ulu.vn/scripts/server.php';
        $this->headers = [
            "Access-Control-Allow-Credentials"=> true,
            "Access-Control-Allow-Origin" => "*",
            "content-type" => "application/x-www-form-urlencoded"
        ];


    }


    public function changeAffiliatePassword( $userId, $password ){

        $affiliate = new Pap_Api_Affiliate($this->session);
        $affiliate->setUserid( $userId );
        try {
            $affiliate->load();

            $affiliate->setPassword($password);
            if( $affiliate->save() ){
                return true;
            }

           // dd($affiliate);

        } catch (Exception $e) {
            return ['success' => false , 'msg' => $affiliate->getMessage() ];
        }
        return false;

    }


    public function saveConsersion($data ){


        $fields = [

            ["multiTier","N"],
            ["sendNotification","N"],
            ["rstatus", 'P' ],
            //["bannerid", $data['bannerid'] ],
            ["userid", $data['userid'] ],
            ["orderid", $data['orderid'] ],
            ["accountid", $data['accountid'] ],
            ["dateinserted", $data['dateinserted'] ],
            ["totalcost", $data['totalcost'] ],
            ["data1", $data['data1'] ],
            ["data2", $data['data2'] ],


        ];

        $arrQuery = [
            'C' => 'Gpf_Rpc_Server',
            'M' => 'run',
            'requests' => [
                [
                    'C' => 'Pap_Merchants_Transaction_TransactionsForm',
                    'M' => 'add',
                    'requests' => $fields
                ]
            ],
            'S' =>  $this->session->getSessionId(),
        ];

        $queryString = 'D='.json_encode($arrQuery);

        // dd($queryString);

        $response =  $this->client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $queryString,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);

        dd($data);
    }

}