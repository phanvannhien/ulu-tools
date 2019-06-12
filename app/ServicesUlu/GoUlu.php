<?php

namespace App\ServicesUlu;
use GuzzleHttp\Client;
use App\Repositories\UluRepositoryEloquent;


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
        return $this->uluRepository->loginAffiliate($requestData);
        
    }

    public function getClickTracking( $token, $params = array() ){
        $url = $this->baseUrl.'/api/click';
        return $this->uluRepository->getData($url, $params, $token);
    }

    public function getConversions( $token, $params = array() ){
        $url = $this->baseUrl.'/api/conversion';
        return $this->uluRepository->getData($url, $params, $token);
    }


}