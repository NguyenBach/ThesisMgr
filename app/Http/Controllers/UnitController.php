<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 21/11/2016
 * Time: 20:46
 */

namespace App\Http\Controllers;



use App\Http\Model\Faculty;
use App\Http\Model\Laboratory;
use App\Http\Model\Office;
use App\Http\Model\Subject;
use App\Http\Model\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function getUnitById($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $unit = Faculty::where('id',$id)->get();
        if(count($unit) <= 0){
            $unit = Subject::where('id',$id)->get();
            if(count($unit) <= 0){
                $unit = Office::where('id',$id)->get();
                if(count($unit) <= 0){
                    $unit = Laboratory::where('id',$id)->get();
                }
            }
        }

        return response()->json($unit,200,$header,JSON_UNESCAPED_UNICODE);
    }

    public function getAllFaculty(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $unit = Faculty::all();
        return response()->json($unit,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getAllSubject($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $unit = Subject::where('facultyid',$id)->get();
        return response()->json($unit,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getAllLaboratory($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $unit = Laboratory::where('facultyid',$id)->get();
        return response()->json($unit,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getAllOffice($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $unit = Office::where('facultyid',$id)->get();
        return response()->json($unit,200,$header,JSON_UNESCAPED_UNICODE);
    }

    public function addUnit(Request $request){
        $unit = $request->input('unit');
        if($unit == 'faculty'){
            $model = new Faculty();
        }
        else if($unit == 'subject'){
            $model = new Subject();
            $model->facultyid = $request->input('facultyid');
        }
        else if($unit == 'laboratory'){
            $model = new Laboratory();
            $model->facultyid = $request->input('facultyid');
        }
        else if($unit == 'office'){
            $model = new Office();
            $model->facultyid = $request->input('facultyid');
        }
        $model->id = $request->input('id');
        $model->name = $request->input('name');
        $model->description = $request->input('description');
        if($model->save()){
            return response()->json(['addunit'=>'true']);
        }else{
            return response()->json(['addunit'=>'false']);
        }

    }
    public function deleteUnit(Request $request){
        $unit = $request->input('unit');
        $id = $request->input('id');
        if($unit == 'faculty'){
            $teachers = Unit::where('faculty',$id)->get();
            foreach ($teachers as $teacher){
                $teacher->faculty = null;
                $teacher->subjects = null;
                $teacher->vpk = null;
                $teacher->ptn = null;
                $teacher->save();
            }
            Subject::where('facultyid',$id)->delete();
            Office::where('facultyid',$id)->delete();
            Laboratory::where('facultyid',$id)->delete();
            $result = Faculty::where('id',$id)->delete();
        }
        else if($unit == 'subject'){
            $teachers = Unit::where('subjects',$id)->get();
            foreach ($teachers as $teacher){
                $teacher->subjects = null;
                $teacher->save();
            }
            $result = Subject::where('id',$id)->delete();
        }
        else if($unit == 'office'){
            $teachers = Unit::where('vpk',$id)->get();
            foreach ($teachers as $teacher){
                $teacher->vpk = null;
                $teacher->save();
            }
            $result = Office::where('id',$id)->delete();
        }
        else if($unit == 'laboratory'){
            $teachers = Unit::where('ptn',$id)->get();
            foreach ($teachers as $teacher){
                $teacher->ptn = null;
                $teacher->save();
            }
            $result = Laboratory::where('id',$id)->delete();
        }
        return response()->json(['result'=>$result]);
    }
}