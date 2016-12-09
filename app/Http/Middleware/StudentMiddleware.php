<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 25/11/2016
 * Time: 20:26
 */

namespace App\Http\Middleware;
use Closure;

class StudentMiddleware
{
    public function handle($request,Closure $next){

       $permission = session('permission');
        if($permission == 2){
            return $next($request);
        }else{
            return redirect('/guest');
        }

    }
}