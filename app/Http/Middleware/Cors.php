<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        if ($request->isMethod('options')) {
           // ->header('Access-Controll-Allow-Methods','POST, GET, OPTIONS, PUT, DELETE')
           // ->header('Access-Controll-Allow-Headers', 'accept, content-type,
            //    x-xsrf-token, x-csrf-token');
        }

        return $next($request);
    }
}
