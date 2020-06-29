<?php

namespace App\Http\Middleware;

use App\helper\Useful;
use Closure;
use Illuminate\Support\Facades\Auth;

class Lang
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
//        dd(session()->has('lang'));
//        app()->setLocale(Useful::getLang());
//        return $next($request);

dd('adaza');
        if (session()->has('lang')){
            app()->setLocale(session('lang'));
        }else{

            app()->setLocale('ar');
        }
                return $next($request);

    }
}
