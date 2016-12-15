<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 07/12/2016
 * Time: 20:26
 */

namespace App\Http\Controllers;


use App\Http\Model\StudentFile;
use App\Http\Model\Thesis;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /*
    * Lấy tất cả các hồ sơ đã nộp của học viên
    * trả về 1 mảng json gồm các hồ sơ
    * */
    public function getFileByStudentId($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $studentFiles = StudentFile::where('student',$id)->get();
        return response()->json($studentFiles,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * Lấy tất cả các hồ sơ đã nộp của tat ca học viên
    * trả về 1 mảng json gồm các hồ sơ
    * */
    public function getAllFile(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $thesis = Thesis::where('ngaybatdau' ,Thesis::max('ngaybatdau'))->where('status',1)->first();
        $studentFiles = StudentFile::where('thesis',$thesis->id)->get();
        return response()->json($studentFiles,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    *Nop ho so
    * */
    public function nopHoSo(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'date'=>'required'
        ]);
        $fileId = $request->input('id');
        $date = $request->input('date');
        $file = StudentFile::where('id',$fileId)->first();
        $file->date = $date;
        $result = $file->save();
        return response()->json(['result'=>$result]);
    }

    public function changeStatus(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'status'=>'required'
        ]);
        $fileId = $request->input('id');
        $status = $request->input('status');
        $file = StudentFile::where('id',$fileId)->first();
        $file->status = $status;
        $result = $file->save();
        return response()->json(['result'=>$result]);
    }
}