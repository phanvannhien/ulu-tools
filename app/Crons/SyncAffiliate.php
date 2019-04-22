<?php
namespace App\Crons;
use GuzzleHttp\Client;


use Pap_Api_Session;
use Pap_Api_Affiliate;
use Gpf_Rpc_Array;
use Pap_Api_AffiliatesGrid;

use App\Models\Affiliate;
use App\Models\Log;



class SyncAffiliate {

    public function sync(){
        $client = new Client();
        $owner = config('ulu.owner');
        $session = new Pap_Api_Session( config('ulu.server') );
        if(! $session->login( $owner['email'], $owner['password']) ) {
            return false;
        }

        $sessionId = $session->getSessionId();

        $columns = [
            array('id'),
            array('refid'),
            array('userid'),
            array('username'),
            array('firstname'),
            array('lastname'),
            array('rstatus'),
            array('parentuserid'),
            array('dateinserted'),
            array('dateapproved'),
            array('note'),
            array('agreetoterms'),
            array('data1'), // website
            array('data2'), // company name
            array('data3'), // Address
            array('data4'), // City
            array('data8'), // phone
            array('deleted'),
            array('photo'),
            array('roleid'),
            array('lastlogin'),
            array('loginscount'),
        ];

        $arrQuery = [
            'C' => 'Gpf_Rpc_Server',
            'M' => 'run',
            'requests' => [
                [
                    'C' => 'Pap_Merchants_User_AffiliatesGridSimple',
                    'M' => 'getRows',
                    'sort_col' => 'dateinserted',
                    'sort_asc' => false,
                    'offset' => 0,
                    'limit' => 100,
                    //'filters' => $filters,
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
            
        $arrKey = [];
        $i = 0;
        foreach($data[0]->rows as $rec) {
         
            if( $i == 0 ){
                $arrKey = $rec;
            }else{
                $arrData = array_combine( $arrKey, $rec  );

                

                Affiliate::updateOrCreate(
                    ['userid' => $arrData['userid'] ],
                    [
                        'userid' => $arrData['userid'],
                        'username' => $arrData['username'],
                        'full_name' => $arrData['firstname'].' '.$arrData['lastname'],
                        'status' => 1,
                        'phone' => $arrData['data8'],
                        'website' => $arrData['data1'],
                        'company' => $arrData['data2'],
                        'address' => $arrData['data3'],
                        'email' => $arrData['username'],
                    ]);

                Log::create([
                    'action' => 'sync_affiliate_PAP',
                        'detail' => $arrData['username']
                    ]);    

            }
        
            $i++;

        }

    }

}