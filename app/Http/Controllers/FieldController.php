<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 22/11/2016
 * Time: 16:42
 */

namespace App\Http\Controllers;


use App\Http\Model\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /*
    * Lấy các lĩnh vực nghiên cứu của giảng viên theo id
     * input $id mã lĩnh vực
    * */
    public function getFieldById($id){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $field = Field::where('id',$id)->get();

        return response()->json($field,200,$header,JSON_UNESCAPED_UNICODE);
    }
    /*
    * Thêm lĩnh vực
    * input: $request có các trường id,tên, giới thiệu
    * */
    public function addField(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
           'id'=>'required',
            'name'=>'required'
        ]);
        $id = $request->input('id');
        $name = $request->input('name');
        $des = $request->input('gt');
        $field = Field::where('id',$id)->get();
        if(count($field) > 0 ) {
            return response()->json(['result'=>false],200,$header,JSON_UNESCAPED_UNICODE);
        }
        $field = new Field();
        $field->id = $id;
        $field->name = $name;
        $field->description = $des;
        $result = $field->save();
        if($result) {
            return response()->json(['result'=>true],200,$header,JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['result'=>false],200,$header,JSON_UNESCAPED_UNICODE);
        }
    }
    /*
        * xóa lĩnh vực
        * */
    public function delete(Request $request){
        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $this->validate($request,[
            'id'=>'required'
        ]);
        $id = $request->input('id');
        $field = Field::where('id',$id)->first();
        if(count($field) <= 0 ) {
            return response()->json(['result'=>false],200,$header,JSON_UNESCAPED_UNICODE);
        }
        $result = $field->delete();
        if($result) {
            return response()->json(['result'=>true],200,$header,JSON_UNESCAPED_UNICODE);
        }else{
            return response()->json(['result'=>false],200,$header,JSON_UNESCAPED_UNICODE);
        }
    }
}