<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 08/12/2016
 * Time: 09:52
 */

namespace App\Http\Controllers;


use App\Http\Model\Thesis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThesisController extends Controller
{
    public function getCurrentThesis(){
        $thesis = Thesis::where('ngaybatdau' ,Thesis::max('ngaybatdau'))->where('status',1)->first();
//        $thesis = null;
        return response()->json($thesis);

    }
    public function addCurrentThesis(Request $request){
        $this->validate($request,[
           'start'=>'required',
            'end'=>'required'
        ]);
        $start = $request->input('start');
        $end = $request->input('end');
        Thesis::where('ngaybatdau',$start)->update(['status'=>2]);
        $thesis = new Thesis();
        $thesis->ngaybatdau = $start;
        $thesis->ngayketthuc = $end;
        $thesis->status = 1;
        $result = $thesis->save();
        if(!$result){
            return response()->json(['result'=>$result]);
        }
        Thesis::where('ngaybatdau','<',$start)->update(['status'=>2]);
        Thesis::where('ngaybatdau','>',$start)->update(['status'=>2]);
        return response()->json(['result'=>$result]);
    }
}