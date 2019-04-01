<?php

namespace App\Http\Middleware;

use Closure;

class SessionMerchantMiddleware
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
        if( session()->has('user') ){
            $request->merchant = session()->get('user')['session'];
            return $next($request);
        }


        return redirect()->route('dashboard');
    }
}
