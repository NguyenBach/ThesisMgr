<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 02/12/2016
 * Time: 08:05
 */

namespace App\Http\Controllers;


use App\Http\Model\Course;
use App\Http\Model\TrainingProgram;
use App\Http\Model\Student;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /*
    * Lấy tất cả các khóa học
    * trả về 1 mảng json
    * */
    public function getAllCourse(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Course::all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * Lấy tất cả các chương trình đào tạo
    * trả về 1 mảng json
    * */
    public function getAllTrain(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = TrainingProgram::all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * Lấy khóa học hay chương trình đào tạo bằng id
    * Input: $type 'course' hoặc 'train', $id
    * trả về 1 mảng json
    * */
    public function getById($type,$id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        if($type == 'course'){
            $returnArray = Course::where('code',$id)->get();
            return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
        }
        if($type == 'train'){
            $returnArray = TrainingProgram::where('code',$id)->get();
            return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
        }

    }
    /*
    * Thêm Khóa học
    * */
    public function addCourse(Request $request){
        $this->validate($request,[
            'ma'=>'required',
            'ten'=>'required',
            'mota'=>'required'
        ]);
        $model = new Course();
        $model->code = $request->input('ma');
        $model->name = $request->input('ten');
        $model->description = $request->input('mota');
        $result = $model->save();
        if($result <= 0){
            return response()->json(['result'=>'false']);
        }else{
            return response()->json(['result'=>'true']);
        }
    }
    /*
    *Thêm chương trình đòa tạo
    * */
    public function addProgram(Request $request){
        $this->validate($request,[
            'ma'=>'required',
            'ten'=>'required',
            'mota'=>'required'
        ]);
        $model = new TrainingProgram();
        $model->code = $request->input('ma');
        $model->name = $request->input('ten');
        $model->description = $request->input('mota');
        $result = $model->save();
        if($result <= 0){
            return response()->json(['result'=>'false']);
        }else{
            return response()->json(['result'=>'true']);
        }

    }
    /*
    * Xóa khóa học hoặc chương trình đào tạo theo id
    * */
    public function delete(Request $request){
        $this->validate($request,[
           'ma'=>'required',
            'a'=>'required'
        ]);
        $ma = $request->input('ma');
        if($request->input('a') == 'train'){
            $model = new TrainingProgram();
            $students = Student::where('ctdt',$ma)->get();
            foreach ($students as $student){
                $student->ctdt = null;
                $student->save();
            }
        }
        else if($request->input('a') == 'course'){
            $model = new Course();
            $students = Student::where('khoahoc',$ma)->get();
            foreach ($students as $student){
                $student->khoahoc = null;
                $student->save();
            }
        }else{
            return response()->json(['result'=> 'false']);
        }
        $v = $model->where('code',$ma)->first();
        $result = $v->delete();
        return response()->json(['result'=> $result]);
    }
}