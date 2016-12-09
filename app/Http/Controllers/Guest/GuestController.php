<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 21/11/2016
 * Time: 13:52
 */

namespace App\Http\Controllers\Guest;


use App\Http\Controllers\Controller;
use App\Http\Model\Faculty;
use App\Http\Model\Field;
use App\Http\Model\Laboratory;
use App\Http\Model\Office;
use App\Http\Model\Subject;
use App\Http\Model\Teacher;

class GuestController extends Controller
{
    public function getAllUnit(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $facultyModel = new Faculty();
        $faculties = $facultyModel->all();
        $facultyArray = [];
        foreach ($faculties as $faculty){
            $subjectModel = new Subject();
            $officeModel = new Office();
            $laboratoryModel = new Laboratory();
            $subjects = $subjectModel->where('facultyid',$faculty->id)->get();
            $offices = $officeModel->where('facultyid',$faculty->id)->get();
            $laboratories = $laboratoryModel->where('facultyid',$faculty->id)->get();
            $subFaculty = ['faculty'=>$faculty,'subject'=>$subjects,'office'=>$offices,'laboratory'=>$laboratories];
            $facultyArray[$faculty->id] = $subFaculty;
        }
        return response()->json($facultyArray,200,$header,JSON_UNESCAPED_UNICODE);
    }
    public function getAllField(){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $fieldModel = new Field();
        $fields = $fieldModel->all();
        return response()->json($fields,200,$header,JSON_UNESCAPED_UNICODE);
    }



}