<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UluRepository.
 *
 * @package namespace App\Repositories;
 */
interface UluRepository extends RepositoryInterface
{
    /**
     * Get Data 
     * @param $url: string
     * @param $params: array
     * @param $token: string
     * @return Object
     */
    public function getData($url,$params, $token);

    /**
     * Get Data 
     * @param $url: string
     * @param $params: array
     * @param $token: string
     * @return Object
     */
    public function postData($url,$params,$token);

    /**
     * Login Affiliate
     * @param $requestData: array
     * @return Object
     */
    public function loginAffiliate($requestData);
}
