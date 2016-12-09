<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 25/11/2016
 * Time: 20:33
 */

namespace App\Http\Middleware;

use Closure;
class Lecturer
{
    public function handle($request,Closure $next){

        $permission = session('permission');
        if($permission == 3){
            return $next($request);
        }else{
            return redirect('/guest');
        }

    }
}