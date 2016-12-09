<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 05/12/2016
 * Time: 08:17
 */

namespace App\Http\Controllers;


use App\Http\Model\Student;
use App\Http\Model\Teacher;
use App\Http\Model\Thesis;
use App\Http\Model\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function getTopicById($type,$id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $thesis = Thesis::where('ngaybatdau' ,Thesis::max('ngaybatdau'))->where('status',1)->first();
        if($type == 'teacher'){
            $returnArray = Topic::where('teacher',$id)->where('thesis',$thesis->id)->get();
            return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
        }
        if($type == 'student'){
            $returnArray = Topic::where('student',$id)->where('thesis',$thesis->id)->get();
            return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);
        }
        return view('404');
    }
    public function getAllTopic(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $returnArray = Topic::all();
        return response()->json($returnArray,200,$header,JSON_UNESCAPED_UNICODE);

    }

    public function acceptTopic(Request $request){
        $accept = ['accept','denied'];
        $this->validate($request,[
            'id'=>'required',
            'act'=>'required'
        ]);
        $topicId = $request->input('id');
        $topic = Topic::where('id',$topicId)->first();
        $act = $request->input('act');
        if($act == 'accept'){
            if($topic->status == 3){
                $topic->status = 1;
                $topic->save();
                return response()->json(['result'=>true]);
            }
        }
        else if($act == 'denied'){
            if($topic->status == 3){
                $topic->status = 2;
                $topic->save();
                return response()->json(['result'=>true]);
            }
        }
    }

    public function addTopic(Request $request){
        $this->validate($request,[
           'studentid'=>'required',
            'teacherid'=>'required',
            'name'=>'required'
        ]);
        $studentid = $request->input('studentid');
        $teacherid = $request->input('teacherid');
        $name = $request->input('name');
        $gt = $request->input('gt');
        $check = Student::where('studentCode',$studentid)->first();
        if(!isset($check)){
            return response()->json(['result'=>false]);
        }
        $check = Teacher::where('teacherCode',$teacherid)->first();
        if(!isset($check)){
            return response()->json(['result'=>false]);
        }
        $thesis = Thesis::where('ngaybatdau' ,Thesis::max('ngaybatdau'))->where('status',1)->first();
        $topic = new Topic();
        $topic->name = $name;
        $topic->description = $gt;
        $topic->student = $studentid;
        $topic->teacher = $teacherid;
        $topic->status = 1;
        $topic->thesis = $thesis->id;
        $result = $topic->save();
        return redirect('/student/topic');

    }
}