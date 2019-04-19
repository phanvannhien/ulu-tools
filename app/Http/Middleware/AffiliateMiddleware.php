<?php

namespace App\Http\Middleware;

use Closure;

class AffiliateMiddleware
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
        if( session()->has('affiliate') ){

            //$sessionUlu = session()->get('affiliate');
            //dd($sessionUlu);
    
            return $next($request);
        }


        auth()->logout();
        return redirect()->route('affiliate.login');
    }
}
