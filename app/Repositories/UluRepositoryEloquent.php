<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UluRepository;
use App\Entities\Ulu;
use App\Validators\UluValidator;
use GuzzleHttp\Client;

/**
 * Class UluRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UluRepositoryEloquent extends BaseRepository implements UluRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Ulu::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get Data 
     * @param $url: string
     * @param $params: array
     * @param $token: string
     * @return Object
     */
    public function getData($url = null, $params = array(), $token= null)
    {   
        $client = new Client();
        $response =  $client->request('GET', $url, [
            'query' => $params,
            'headers' => [
                'authorization' => !empty($token) ? 'Bearer '.$token : '',
            ],
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }    

    /**
     * Get Data 
     * @param $url: string
     * @param $params: array
     * @param $token: string
     * @return Object
     */
    public function postData($url = null,$params = array(), $token = null){
        
        $client = new Client();
        $response =  $client->request('POST', $url, [
            'json' => $params,
            'headers' => [
                'authorization' => !empty($token) ? 'Bearer '.$token : '',
            ],
        ]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }

    /**
     * Login Affiliate
     * @param $requestData: array
     * @return Object
     */
    public function loginAffiliate($url,$requestData){
        $client = new Client();
        $response =  $client->request('POST', $url, ['json' => $requestData]);
        $data = $response->getBody()->getContents();
        $data = json_decode( $data );
        return $data ;
    }
    
}
