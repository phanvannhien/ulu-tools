<?php
namespace App\ServicesUlu;
use GuzzleHttp\Client;
use App\Repositories\UluRepositoryEloquent;

class AdminUlu{
    protected $baseUrl;
    private $uluRepository;

    public function __construct(UluRepositoryEloquent $uluRepository)
    {
        if( env('APP_ENV') == 'local'){
            $this->baseUrl = env('API_LOCAL_BASE_URL');
        }else{
            $this->baseUrl = env('API_SERVER_BASE_URL');
        }
        $this->uluRepository = $uluRepository;

    }

    /**
     * @param array $params
     * @return mixed|string
     * GET traffic 
     */
    public function getTraffic( $params = array() ){
        $url = $this->baseUrl.'/api/admin/traffic';
        return $this->uluRepository->getData($url, $params);
    }

    public function getConversions( $params = array() ){
        $url = $this->baseUrl.'/api/admin/conversion';
        return $this->uluRepository->getData($url, $params);
    }

    public function importConversions( $params = array() ){
        $url = $this->baseUrl.'/api/admin/conversion';
        return $this->uluRepository->postData($url, $params);
    }


}
