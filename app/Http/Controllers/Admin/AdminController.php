<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 06/11/2016
 * Time: 11:07
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\TeacherController;
use App\Http\Model\Course;
use App\Http\Model\Student;
use App\Http\Model\TrainingProgram;
use App\Http\Model\User;
use Illuminate\Http\Request;
use PHPExcel_IOFactory;

class AdminController extends Controller
{
    public function index(){
        return 'adfsasdf';
    }
    public function addTeacherExcel(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
            'excel'=>'required'
        ]);
        $excelColumn = ['A','B','C','D'];
        $excel = $request->file('excel');
        $inputFileType = PHPExcel_IOFactory::identify($excel);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($excel);
        $data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $a =[];
        foreach ($data as $key => $row){
            if($row['A'] == 'teacherCode'){
                continue;
            }
           if(isset($row['A'])){
               $result[$key] = TeacherController::addTeacherToDB($row['A'],$row['B'],$row['C'],$row['D']);
           }

        }

        return response()->json($result,200,$header,JSON_UNESCAPED_UNICODE);

    }
    public function addStudentExcel(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
            'excel'=>'required'
        ]);
        $excelColumn = ['A','B','C','D'];
        $excel = $request->file('excel');
        $inputFileType = PHPExcel_IOFactory::identify($excel);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($excel);
        $data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $a =[];
        foreach ($data as $key => $row){
            if($row['A'] == 'studentCode'){
                continue;
            }
            if(isset($row['A'])){
                $student['studentCode'] = $row['A'];
                $student['fullname'] = $row['B'];
                $student['course'] = $row['C'];
                $student['train'] = $row['D'];
                $student['email'] = $row['E'];
                $result[$key] = $this->addStudentToDB($student);
            }

        }

        return response()->json($result,200,$header,JSON_UNESCAPED_UNICODE);

    }
    public function addStudentStatusExcel(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
            'excel'=>'required'
        ]);
        $excelColumn = ['A','B','C','D'];
        $excel = $request->file('excel');
        $inputFileType = PHPExcel_IOFactory::identify($excel);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($excel);
        $data = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $a =[];
        foreach ($data as $key => $row){
            if($row['A'] == 'studentCode'){
                continue;
            }
            if(isset($row['A'])){
                $studentCode = $row['A'];
                $student = Student::where('studentCode',$studentCode)->first();
                if(isset($student)){
                    $student->status = 1;
                    $student->save();
                    $result[$key] = true;
                }else{
                    $result[$key] = false;
                }

            }

        }

        return response()->json($result,200,$header,JSON_UNESCAPED_UNICODE);

    }
    public function addStudentToDB($student){
        $studentCode = $student['studentCode'];
        $fullname = $student['fullname'];
        $course = $student['course'];
        $train = $student['train'];
        $email = $student['email'];
        $check = User::where('username',$studentCode)->get();
        if(count($check) > 0) {
           $result = false;
            return $result;
        }
        $check = Student::where('studentCode',$studentCode)->get();
        if(count($check) > 0) {
            $result = false;
            return $result;
        }
        $check = Course::where('code',$course)->get();
        if(count($check) <= 0) {
            $result = false;
            return $result;
        }
        $check = TrainingProgram::where('code',$train)->get();
        if(count($check) <= 0) {
            $result = false;
            return $result;
        }
        $user = new User();
        $user->username = $studentCode;
        $user->password = $studentCode;
        $user->permission = '2';
        $result = $user->save();
        if($result <= 0){
            $result = false;
            return $result;
        }
        $student = new Student();
        $student->studentCode = $studentCode;
        $student->fullname = $fullname;
        $student->khoahoc = $course;
        $student->ctdt = $train;
        $student->vnuMail = $email;
        $student->status = 2;
        $userId = User::where('username',$studentCode)->first();
        $student->userid = $userId->id;
        $result = $student->save();
        if($result <= 0){
            $del = User::where('username',$studentCode)->first();
            if(isset($del)) $del->delete();
            $result = false;
            return $result;
        }
        $result = true;
        return $result;
    }
}