<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class GetUrlOrigem
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
        $response = $next($request);


        if ($request->session()->exists('url_origem') == null) {
            $request->session()->forget('url_origem');            
        }

        if (!$request->session()->exists('url_origem') && isset($_SERVER['HTTP_REFERER'])) {
            $request->session()->put('url_origem', $_SERVER['HTTP_REFERER']);    
        }
        
        return $response;        
    }
}
