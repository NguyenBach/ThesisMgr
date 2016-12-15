<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 21/11/2016
 * Time: 15:40
 */

namespace App\Http\Controllers;


use App\Http\Model\Faculty;
use App\Http\Model\Field;
use App\Http\Model\Laboratory;
use App\Http\Model\Office;
use App\Http\Model\PhanBien;
use App\Http\Model\Research;
use App\Http\Model\Subject;
use App\Http\Model\Teacher;
use App\Http\Model\TeacherField;
use App\Http\Model\Topic;
use App\Http\Model\Unit;
use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function getAllTeacher(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = [];
        $teacherModel = new Teacher();
        $returnArray = $teacherModel->all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getTeacherById($teacherCode){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $teacherModel = new Teacher();
        $returnArray = $teacherModel->where('teacherCode',$teacherCode)->get();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getNumberTeacher(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $teacherModel = new Teacher();
        $returnArray['count'] = $teacherModel->count();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }

    public function getNineTeacher($page){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $teacherModel = new Teacher();
        $returnArray = $teacherModel->offset($page*9)->limit(9)->get();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function filterTeacherByUnit($unitId){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = [];
        $units = Unit::where('faculty',$unitId)->orwhere('subjects',$unitId)->orwhere('vpk',$unitId)->orwhere('ptn',$unitId)->get();
        foreach ($units as $unit){
            $returnArray[$unit->teacherCode] = Teacher::where('teacherCode',$unit->teacherCode)->get();
        }
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function filterTeacherByField($fieldid){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = [];
        $fields = TeacherField::where('linhvuc',$fieldid)->get();
        foreach ($fields as $field){
            $returnArray[$field->teacherCode] = Teacher::where('teacherCode',$field->teacherCode)->get();
        }
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getTeacherUnit($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $units = Unit::where('teacherCode',$id)->get();
        foreach ($units as $unit){
            $model = Faculty::find($unit->faculty);
            $returnArray['faculty'] = $model->name;
            if(isset($unit->subjects)){
                $model = Subject::find($unit->subjects);
                $returnArray['subject'] = $model->name;
            }
            if(isset($unit->vpk)){
                $model = Office::find($unit->vpk);
                $returnArray['office'] = $model->name;
            }
            if(isset($unit->ptn)){
                $model = Laboratory::find($unit->ptn);
                $returnArray['laboratory'] = $model->name;
            }
        }

        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * thêm giảng viên
    * */
    public function addTeacher(Request $request){
        $this->validate($request,[
            'teachercode'=>'required|not_in:""," ",null',
            'fullname'=>'required|not_in:""," ",null',
            'unit'=>'required|not_in:""," ",null',
            'email'=>'required|not_in:""," ",null',

        ]);

        $teacherCode = $request->input('teachercode');
        $fullname = $request->input('fullname');
        $unit = $request->input('unit');
        $email = $request->input('email');
        $result = self::addTeacherToDB($teacherCode,$fullname,$email,$unit);
        return response()->json(['result'=>$result]);

    }
    /*
    * xóa giảng viên
    * */

    public function deleteTeacher(Request $request){
        $this->validate($request,[
            'teachercode'=>'required|not_in:""," ",null',
        ]);
        $teacherCode = $request->input('teachercode');
        $teacher = Teacher::where('teacherCode',$teacherCode)->first();
        if(isset($teacher)){
            $topics = Topic::where('teacher',$teacherCode)->get();
            $this->preDelete($topics);
            $pb = PhanBien::where('teacher',$teacherCode)->get();
            foreach ($pb as $p){
                $p->teacher = null;
                $p->save();
            }
            $teacherFields = TeacherField::where('teacherCode',$teacherCode)->get();
            $this->preDelete($teacherFields);
            $researches = Research::where('teachercode',$teacherCode)->get();
            $this->preDelete($researches);
            $unit = Unit::where('teacherCode',$teacherCode)->get();
            $this->preDelete($unit);
            $teacher->delete();
            $user = User::where('username',$teacherCode)->first();
            $user->delete();
            return response()->json(['result'=>true]);
        }else{
            return response()->json(['result'=>false]);
        }

    }
    private function preDelete($fields){
        foreach ($fields as $field){
            $field->delete();
        }
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
        $teacher = Teacher::where('teacherCode',$teacherCode)->first();
        $teacher->imgurl = '/storage/avatar/'.$filename;
        $result = $teacher->save();
        return response()->json(['result'=>$result]);
    }

    public function getResearchTopic($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Research::where('teachercode',$id)->get();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }

    public function addResearchTopic(Request $request){
        $this->validate($request,[
           'id'=>'required',
            'ten'=>'required',
        ]);
        $teacherCode = $request->input('id');
        $name = $request->input('ten');
        $describe = $request->input('gt');
        if(!isset($describe)) $describe = "";
        $research = new Research();
        $research->name = $name;
        $research->teachercode = $teacherCode;
        $research->description = $describe;
        $value = $research->save();
        return response()->json(['result'=>$value]);
    }

    public function getTeacherField($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $fields = TeacherField::where('teacherCode',$id)->get();
        $returnArray = [];
        foreach ($fields as $field){
            $returnArray[$field->linhvuc] = Field::where('id',$field->linhvuc)->first();
        }
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
    }

    public function addTeacherField(Request $request){
        $this->validate($request,[
            'id'=>'required'
        ]);
        $teacherCode = $request->input('id');
        $fields = $request->input('linhvuc');
        if(!isset($fields)) $fields = [];
        $teachers = TeacherField::where('teacherCode',$teacherCode)->get();
        $teacherFields = [];
        foreach ($teachers as $teacher){
            array_push($teacherFields,$teacher->linhvuc);
        }
        foreach ($fields as $key => $field){
            if(!in_array($field,$teacherFields)) {
                $lv = new TeacherField();
                $lv->teacherCode = $teacherCode;
                $lv->linhvuc = $field;
                $lv->save();
            }
        }
        foreach ($teacherFields as $teacherField){
            if(!in_array($teacherField,$fields)){
                $lv = TeacherField::where('linhvuc',$teacherField)->first();
                $lv->delete();
            }
        }
        return response()->json(['result'=>true]);
    }

    public static function addTeacherToDB($teacherCode,$fullname,$email,$unit){
        if(count(User::where('username',$teacherCode)->get()) > 0){
            $result = false;
            return $result;
        }
        $model = new User();
        $model->username = $teacherCode;
        $model->password = '12345678';
        $model->permission = '3';
        $result = $model->save();
        if($result <= 0){
            $result = false;
            return $result;
        }
        $userId = User::where('username',$teacherCode)->first();
        $model = new Teacher();
        $model->fullName = $fullname;
        $model->teacherCode = $teacherCode;
        $model->vnuMail = $email;
        $model->userid = $userId->id;
        $result = $model->save();
        if($result <= 0) {
            TeacherController::deleteIfError($teacherCode);
            $result = false;
            return $result;
        }
        $units = TeacherController::getUnitId($unit);
        if(is_null($units)){
            TeacherController::deleteIfError($teacherCode);
            $result = false;
            return $result;
        }
        if(key_exists('faculty',$units)){
            $model = new Unit();
            $model->teacherCode = $teacherCode;
            $model->faculty = $units['faculty'];
            $result = $model->save();
            if($result <= 0) {
                TeacherController::deleteIfError($teacherCode);
                $result = false;
                return $result;
            }
        }
        else if(key_exists('subject',$units) || key_exists('office',$units) || key_exists('laboratory',$units)){
            $model = new Unit();
            $model->teacherCode = $teacherCode;
            $model->faculty = $units['facultyid'];
            if(isset($units['subject'])) $model->subjects = $units['subject'];
            else if(isset($units['office'])) $model->vpk = $units['office'];
            else $model->ptn = $units['laboratory'];
            $result = $model->save();
            if($result <= 0) {
                TeacherController::deleteIfError($teacherCode);
                $result = false;
                return $result;
            }
        }
        $result = true;
        return $result;
    }

    public static function deleteIfError($teacherCode){
        $del = Teacher::where('teacherCode',$teacherCode)->first();
        if($del != '') $del->delete();
        $del = User::where('username',$teacherCode)->first();
        if(isset($del)) $del->delete();

    }


    public static function getUnitId($unit){
        $check = Faculty::where('name',$unit)->first();
        if(isset($check)){
            return ['faculty'=>$check->id];
        }else{
            $check = Subject::where('name',$unit)->first();
            if(isset($check)){
                return ['subject'=>$check->id,'facultyid'=>$check->facultyid];
            }else{
                $check = Office::where('name',$unit)->first();
                if(isset($check)){
                    return ['office'=>$check->id,'facultyid'=>$check->facultyid];
                }else{
                    $check = Laboratory::where('name',$unit)->first();
                    if(isset($check)){
                        return ['laboratory'=>$check->id,'facultyid'=>$check->facultyid];
                    }else{
                        return null;
                    }
                }
            }
        }
    }
}