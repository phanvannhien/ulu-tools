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


}