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
use App\Http\Model\StudentFile;
use App\Http\Model\Teacher;
use App\Http\Model\Topic;
use App\Http\Model\TrainingProgram;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use PHPExcel_IOFactory;
use PHPExcel;

class AdminController extends Controller
{
    /*
     * Thêm giảng viên bằng excel
     * Request excel kiểu file
     * */
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
    /*
     * Thêm học viên bằng excel
     * Request excel kiểu file
     * */
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
    /*
     * Thêm trạng thái đăng ký của học viên bằng excel
     * Request excel kiểu file
     * */
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

    /*
     * export de tai
     * */
    public function toTopicExcel(){
        $excel = new PHPExcel();
        $excel->getProperties()->setTitle('Topic');
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('Topic');
        $columns = Schema::getColumnListing('detai');
        $currentRow = 1;
        $currentColumn = 'A';
        foreach ($columns as $column){
            $currentCell = $currentColumn.$currentRow;
            $sheet->setCellValue($currentCell,$column);
            $currentColumn = chr(ord($currentColumn)+1);
        }
        $data = Topic::where('status',1)->get();
        $currentRow = 2;
        foreach ($data as $topic){
            $sheet->setCellValue('A'.$currentRow,$topic->id);
            $sheet->setCellValue('B'.$currentRow,$topic->name);
            $sheet->setCellValue('C'.$currentRow,$topic->description);
            $student = Student::where('studentCode',$topic->student)->first();
            $sheet->setCellValue('D'.$currentRow,$student->fullname);
            $teacher = Teacher::where('teacherCode',$topic->teacher)->first();
            $sheet->setCellValue('E'.$currentRow,$teacher->fullName);
            $currentRow++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $path = storage_path('/excel/export.xls');
        $objWriter->save($path);
        return response()->download($path);
    }

    /*
    * export ho so
    * */
    public function toFileAcceptExcel(){
        $excel = new PHPExcel();
        $excel->getProperties()->setTitle('File');
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('File');
        $sheet->setCellValue('A1','Stt');
        $sheet->setCellValue('B1','Student');
        $sheet->setCellValue('C1','Topic');
        $data = StudentFile::where('status','Chấp nhận')->get();
        $currentRow = 2;
        foreach ($data as $a){
            $sheet->setCellValue('A'.$currentRow,$currentRow-1);
            $student = Student::where('studentCode',$a->student)->first();
            $sheet->setCellValue('B'.$currentRow,$student->fullname);
            $topic = Topic::where('id',$a->topic)->first();
            $sheet->setCellValue('C'.$currentRow,$topic->name);
            $currentRow++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
        $path = storage_path('/excel/exportfile.xls');
        $objWriter->save($path);
        return response()->download($path);
    }

    /*
     * Thêm học viên vào database
     * input: $student các thông tin của sinh viên gồm mã, tên,khóa học ,chương trình đào tạo,email,...
     * output: $result true nếu add được false nếu ko
     * */
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

    public function mail(){
        $title = 'Hello';
        $content='asdfasdfads';
        Mail::send('activeMail', ['username' => $title, 'password' => $content], function ($message)
        {
            $message->from('myside@gmail.com', 'Christian Nwamba');
            $message->to('bachnq214@gmail.com');
        });

    }
}