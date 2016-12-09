<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 07/12/2016
 * Time: 20:26
 */

namespace App\Http\Controllers;


use App\Http\Model\StudentFile;

class FileController extends Controller
{
    public function getFileByStudentId($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $studentFiles = StudentFile::where('student',$id)->get();
        return response()->json($studentFiles,200,$header,JSON_UNESCAPED_UNICODE);
    }
}