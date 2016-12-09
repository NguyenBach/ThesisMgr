<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 21/11/2016
 * Time: 15:09
 */

namespace App\Http\Middleware;


use Closure;

class Guest
{
    public function handle($request,Closure $next){
        if(session('permission') == null){
            return $next($request);
        }else{
            return response()->view('404');
        }
    }
}