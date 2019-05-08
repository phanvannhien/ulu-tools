<?php

namespace App\Services;
use GuzzleHttp\Client;


class GoUlu{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:4200';
    }

    public function loginAffiliate( $email, $password ){
        $url = $this->baseUrl.'/api/affiliate/login';

        $client = new Client();
        $requestData = [
            'email' => $email,
            'password' => $password
        ];

        $response =  $client->request('POST', $url, ['json' => $requestData]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }

    public function getClickTracking( $token, $params = array() ){
        $url = $this->baseUrl.'/api/click';
        $client = new Client();

        $response =  $client->request('GET', $url, [
            'headers' => [
                'authorization' => 'Bearer '.$token,
            ],
            'query' => $params
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }


    public function getConversions( $token, $params = array() ){
        $url = $this->baseUrl.'/api/conversion';
        $client = new Client();

        $response =  $client->request('GET', $url, [
            'headers' => [
                'authorization' => 'Bearer '.$token,
            ],
            'query' => $params
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }


}