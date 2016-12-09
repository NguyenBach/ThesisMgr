<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 18/11/2016
 * Time: 09:24
 */

namespace App\Http\Controllers\Login;


use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function checkLogin(Request $request, $userName, $password)
    {
        $users = User::where('username', $userName)->get();
        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user['password'] == $password) {
                    $request -> session()->put('userid',$userName);
                    $request->session()->put('permission',$user['permission']);
                    return response()->json(['login'=>'true']);
                }else{

                    return response()->json(['login'=>'false']);
                }
            }
        }else{
           return response()->json(['login'=>'false']);

        }

    }

    public function logout(Request $request){
        $request->session()->clear();
        $request->session()->flush();
        return response()->view('TestView');
    }


    public function changePassword(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
            'id'=>'required',
            'new'=>'required',
            'repeat'=>'required',
            'old'=>'required'
        ]);
        $userid = $request->input('id');
        $new = $request->input('new');
        $repeat = $request->input('repeat');
        $old = $request->input('old');
        if($repeat != $new){
            return response()->json(['result'=>'Nhập lại sai mật khẩu'],200,$header,JSON_UNESCAPED_UNICODE);
        }
        $user = User::where('username',$userid)->first();
        if(!isset($user)){
            return response()->json(['result'=>'Tài khoản không tồn tại'],200,$header,JSON_UNESCAPED_UNICODE);
        }
        if($user->password != $old){
            return response()->json(['result'=>'Sai mật khẩu cũ'],200,$header,JSON_UNESCAPED_UNICODE);
        }
        $user->password = $new;
        $user->save();
        return response()->json(['result'=>'Thay đổi thành công'],200,$header,JSON_UNESCAPED_UNICODE);
    }

}