<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Pap_Api_Session;


class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( session()->has('merchant') ){
            return $next($request);
        }

        $session = new Pap_Api_Session( config('ulu.server') );
        if(! $session->login('pap-support@ulf.vn','xoWC$WBG89#z')) {
            die('Merchant login fail');
        }

        Session::put('merchant', $session);
        return $next($request);

    }
}
