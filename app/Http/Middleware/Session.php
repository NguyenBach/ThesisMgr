<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 20/11/2016
 * Time: 20:37
 */

namespace App\Http\Middleware;
use Closure;

class Session
{
    public function handle($request,Closure $next){
        $path = $request->path();
        $explodePath = explode('/',$path);
        $per = ['admin'=>'1','student'=>'2','lecturer'=>'3'];
        $redirect = ['1'=>'/admin','2'=>'/student','3'=>'/lecturer'];
        if(session('permission') == null){
            if($explodePath[0] == 'guest'){
                return $next($request);
            }
            return redirect('/guest');
        }
        if(array_key_exists($explodePath[0],$per)){
            if(session('permission') == $per[$explodePath[0]]){
                return $next($request);
            }else{
                return redirect($redirect[session('permission')]);
            }
        }else{
            return redirect($redirect[session('permission')]);
        }

    }
}