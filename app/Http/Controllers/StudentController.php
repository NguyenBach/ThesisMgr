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
use App\Http\Model\StudentFile;
use App\Http\Model\Topic;
use App\Http\Model\TrainingProgram;
use App\Http\Model\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /*
    * Lấy tất cả các sinh viên
    * trả về 1 mảng json
    * */
    public function getAllStudent(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Student::all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * Lấy sinh viên theo id
    * trả về 1 mảng json
    * */
    public function getStudentById($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Student::where('studentCode',$id)->first();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    *thêm sinh viên
    * */
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
    /*
    * xóa sinh viên
    * */
    public function delete(Request $request){
        $this->validate($request,[
            'ma'=>'required'
        ]);
        $studentCode = $request->input('ma');
        $del = Student::where('studentCode',$studentCode)->first();
        if(isset($del)){
            $topics = Topic::where('student',$studentCode)->get();
            foreach ($topics as $topic){
                $topic->delete();
            }
            $studentfiles = StudentFile::where('student',$studentCode)->get();
            foreach ($studentfiles as $studentfile){
                $studentfile->delete();
            }
            $del->delete();
        }else{
            return response()->json(['result'=>false]);
        }
        $del = User::where('username',$studentCode)->first();
        if(isset($del)) $del->delete();
        return response()->json(['result'=>true]);
    }
    /*
    * thay đổi trạng thái đăng ký khóa luận của sinh viên
    * */
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
    /*
    * thay đổi avatar
    * */
    public function changeAvatar(Request $request){
        $this->validate($request, [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id'=>'required'
        ]);
        $image = $request->file('avatar');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = storage_path('avatar');
        $image->move($destinationPath, $filename);
        $teacherCode = $request->input('id');
        $teacher = Student::where('studentCode',$teacherCode)->first();
        $teacher->imgurl = '/storage/avatar/'.$filename;
        $result = $teacher->save();
        return response()->json(['result'=>$result]);
    }
}