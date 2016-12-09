<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 18/11/2016
 * Time: 20:45
 */

namespace App\Http\Middleware;
use Closure;

class LoginMiddleware
{

    public function handle($request,Closure $next){

        return $next($request);
    }
    public function terminate($request, $response)
    {

    }
}