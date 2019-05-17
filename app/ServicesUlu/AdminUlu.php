<?php
namespace App\ServicesUlu;
use GuzzleHttp\Client;



class AdminUlu{
    protected $baseUrl;

    public function __construct()
    {
        if( env('APP_ENV') == 'local'){
            $this->baseUrl = env('API_LOCAL_BASE_URL');
        }else{
            $this->baseUrl = env('API_SERVER_BASE_URL');
        }

    }

    /**
     * @param array $params
     * @return mixed|string
     * GET traffic 
     */
    public function getTraffic( $params = array() ){
        $url = $this->baseUrl.'/api/admin/traffic';
        $client = new Client();
        $response =  $client->request('GET', $url, [
            'query' => $params
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }


    public function getConversions( $params = array() ){
        $url = $this->baseUrl.'/api/admin/conversion';
        $client = new Client();

        $response =  $client->request('GET', $url, [
            'query' => $params
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }


}
