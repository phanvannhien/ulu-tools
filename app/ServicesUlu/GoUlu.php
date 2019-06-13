<?php

namespace App\ServicesUlu;
use GuzzleHttp\Client;
use App\Repositories\UluRepositoryEloquent;
use App\Models\Campaign;


class GoUlu{
    protected $baseUrl;
    private $uluRepository;

    public function __construct()
    {
        if( env('APP_ENV') == 'local'){
            $this->baseUrl = env('API_LOCAL_BASE_URL');
        }else{
            $this->baseUrl = env('API_SERVER_BASE_URL');
        }
        $this->uluRepository = app(UluRepositoryEloquent::class);
    }

    public function createShortLink( $token, $params  ){
        $url = $this->baseUrl.'/api/url';
        return $this->uluRepository->postData($url, $params, $token);
    }

    public function getLinkHistory( $token, $params  ){
        $url = $this->baseUrl.'/api/url';
        return $this->uluRepository->getData($url, $params, $token);
    }

    public function loginAffiliate( $email, $password ){
        $url = $this->baseUrl.'/api/affiliate/login';
        $requestData = [
            'email' => $email,
            'password' => $password
        ];
        return $this->uluRepository->loginAffiliate($url,$requestData);
    }

    public function getClickTracking( $token, $params = array() ){
        $url = $this->baseUrl.'/api/click';
        return $this->uluRepository->getData($url, $params, $token);
    }

    public function getConversions( $token, $params = array() ){
        $url = $this->baseUrl.'/api/conversion';
        return $this->uluRepository->getData($url, $params, $token);
    }

    public function createConvension($token,$params = array()){
        $campaign = Campaign::select('id','campaign_id','campaign_name')->where('campaign_id',$params['campaign_id'])->first();
        $orders = $this->createOrder($params['convension_number'],$campaign->campaign_name);
        $params['orders'] = $orders;
        $params['order_id'] = $campaign->campaign_name.'_'.rand(1,1000);
        $url = $this->baseUrl.'/api/conversion';
        return $this->uluRepository->postData($url, json_decode(json_encode($params)),$token);
    }

    private function createOrder($convensionNumbers,$campaignName){
        $orders = array();
        for($i = 0; $i < $convensionNumbers; $i++ ){
            array_push($orders, [
                'product_id' => 'product_'.$campaignName.'_'.rand(1,1000),
                'total_cost' => 100000
            ]);
        }
        return $orders;
    }


}