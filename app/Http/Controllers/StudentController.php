<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 04/12/2016
 * Time: 20:24
 */

namespace App\Http\Controllers;


use App\Http\Model\Course;
use App\Http\Model\Student;
use App\Http\Model\TrainingProgram;
use App\Http\Model\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getAllStudent(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Student::all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getStudentById($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Student::where('studentCode',$id)->first();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function addStudent(Request $request){
        $this->validate($request,[
           'ma'=>'required',
            'ten'=>'required',
            'khoahoc'=>'required',
            'ctdt'=>'required',
            'email'=>'required'
        ]);
        $studentCode = $request->input('ma');
        $fullname = $request->input('ten');
        $course = $request->input('khoahoc');
        $train = $request->input('ctdt');
        $email = $request->input('email');
        $check = User::where('username',$studentCode)->get();
        if(count($check) > 0) {
            return response()->json(['result'=>false]);
        }
        $check = Student::where('studentCode',$studentCode)->get();
        if(count($check) > 0) {
            return response()->json(['result'=>false]);
        }
        $check = Course::where('code',$course)->get();
        if(count($check) <= 0) {
            return response()->json(['result'=>false]);
        }
        $check = TrainingProgram::where('code',$train)->get();
        if(count($check) <= 0) {
            return response()->json(['result'=>false]);
        }
        $user = new User();
        $user->username = $studentCode;
        $user->password = $studentCode;
        $user->permission = '2';
        $result = $user->save();
        if($result <= 0){
            return response()->json(['result'=>false]);
        }
        $student = new Student();
        $student->studentCode = $studentCode;
        $student->fullname = $fullname;
        $student->khoahoc = $course;
        $student->ctdt = $train;
        $student->vnuMail = $email;
        $student->status = 1;
        $userId = User::where('username',$studentCode)->first();
        $student->userid = $userId->id;
        $result = $student->save();
        if($result <= 0){
            $del = User::where('username',$studentCode)->first();
            if(isset($del)) $del->delete();
            return response()->json(['result'=>false]);
        }
        return response()->json(['result'=>$result]);
    }
    public function delete(Request $request){
        $this->validate($request,[
            'ma'=>'required'
        ]);
        $studentCode = $request->input('ma');
        $del = Student::where('studentCode',$studentCode)->first();
        if(isset($del)){
            $del->delete();
        }else{
            return response()->json(['result'=>false]);
        }
        $del = User::where('username',$studentCode)->first();
        if(isset($del)) $del->delete();
        return response()->json(['result'=>true]);
    }

    public function changeStatus(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'status'=>'required'
        ]);
        $studentId = $request->input('id');
        $status = $request->input('status');
        $student = Student::where('studentCode',$studentId)->first();
        if(!isset($student)){
            return response()->json(['result'=>false]);
        }
        $student->status = $status;
        $result = $student->save();
        return response()->json(['result'=>$result]);
    }
}