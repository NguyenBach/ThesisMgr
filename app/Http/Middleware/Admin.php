<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 25/11/2016
 * Time: 20:34
 */

namespace App\Http\Middleware;
use Closure;

class Admin
{
    public function handle($request,Closure $next){

        $permission = session('permission');
        if($permission == 1){
            return $next($request);
        }else{
            return redirect('/guest');
        }

    }
}