<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| This file is where you may define all of the routes that are handled
//| by your application. Just tell Laravel the URIs it should respond
//| to using a Closure or controller method. Build something great!
//|
//*/
//
//
//


Route::group(['middleware' => ['web']], function () {
    Route::get('/login/{userName}/{password}', 'Login\LoginController@checkLogin');
    Route::get('/logout','Login\LoginController@logout');
});
Route::group(['middleware'=>'check'],function (){
    Route::get('/', function () {
        return view('guest.index');
    });
    Route::get('/admin',function (){
        return view('admin.index');
    });
    Route::get('/student',function (){
        return view('student.index');
    });
    Route::get('/lecturer',function (){
        return view('teacher.index');
    });
    Route::get('/guest',function (){
        return view('guest.index');
    });
});
Route::group(['middleware'=>'guest'],function (){
    Route::get('/guest/donvi',function (){
        return view('guest.donvi');
    });
    Route::get('/guest/linhvuc',function (){
        return view('guest.linhvuc');
    });
    Route::get('/guest/teacher',function (){
        return view('guest.giangvien');
    });

});

Route::group(['middleware'=>'student'],function (){
    Route::get('/student/findteacher',function (){
        return view('student.findteacher');
    });
    Route::get('/student/topic',function (){
        return view('student.detai');
    });
    Route::get('/student/file',function (){
        return view('student.hoso');
    });
    Route::get('/student/profile',function (){
        return view('student.profile');
    });
});

Route::group(['middleware'=>'lecturer'],function (){
    Route::get('/lecturer/findteacher',function (){
        return view('teacher.findteacher');
    });
    Route::get('/lecturer/topic',function (){
        return view('teacher.detai');
    });
    Route::get('/lecturer/profile',function (){
        return view('teacher.profile');
    });
});

Route::group(['middleware'=>'admin'],function (){
    Route::get('/admin/findteacher',function (){
        return view('teacher.findteacher');
    });
    Route::get('/admin/topic',function (){
        return view('teacher.detai');
    });
    Route::get('/admin/profile',function (){
        return view('teacher.file');
    });
});




Route::get('/test',function (){
    $a = \App\Http\Model\User::where('id',100)->first();
    if(isset($a))
    return 'aaa' ;
    else return 'bbb';
});

Route::post('/changepassword','Login\LoginController@changePassword');

Route::post('/changeavatar','TeacherController@changeAvatar');

Route::post('/unit','UnitController@addUnit');
Route::post('/deleteunit','UnitController@deleteUnit');
Route::post('/addteacher','TeacherController@addTeacher');


Route::get('/unit','Guest\GuestController@getAllUnit');
Route::get('/unit/{id}','UnitController@getUnitById');

Route::post('/excelupload','TeacherController@uploadExcel');

Route::get('/course','ProgramController@getAllCourse');
Route::get('/train','ProgramController@getAllTrain');
Route::get('/program/{type}/{id}','ProgramController@getById');

Route::post('/course','ProgramController@addCourse');
Route::post('/train','ProgramController@addProgram');
Route::post('/deleteprogram','ProgramController@delete');


Route::get('/allstudent','StudentController@getAllStudent');
Route::post('/addstudent','StudentController@addStudent');
Route::post('/deletestudent','StudentController@delete');

Route::get('/field','Guest\GuestController@getAllField');
Route::get('/teacher','TeacherController@getAllTeacher');
Route::get('/teacher/{teacherid}','TeacherController@getTeacherById');
Route::get('/teachernumber','TeacherController@getNumberTeacher');
Route::get('/teacherunitfilter/{unitId}','TeacherController@filterTeacherByUnit');
Route::get('/nine/{page}','TeacherController@getNineTeacher');

Route::get('/field/{id}','FieldController@getFieldById');
Route::get('/teacherfieldfilter/{fieldid}','TeacherController@filterTeacherByField');
Route::get('/faculty','UnitController@getAllFaculty');
Route::get('/office/{id}','UnitController@getAllOffice');
Route::get('/subject/{id}','UnitController@getAllSubject');
Route::get('/laboratory/{id}','UnitController@getAllLaboratory');
Route::get('/teacherunit/{id}','TeacherController@getTeacherUnit');

Route::get('/getstudent/{id}','StudentController@getStudentById');

Route::get('/topic/{type}/{id}','TopicController@getTopicById');

Route::post('/accepttopic','TopicController@acceptTopic');
Route::get('/alltopic','TopicController@getAllTopic');
Route::post('/addtopic','TopicController@addTopic');

Route::get('/getresearch/{id}','TeacherController@getResearchTopic');
Route::post('/addresearch','TeacherController@addResearchTopic');

Route::get('/teacherfield/{id}',"TeacherController@getTeacherField");
Route::post('/addteacherfield','TeacherController@addTeacherField');

Route::get('/studentfile/{id}','FileController@getFileByStudentId');

Route::post('/addfield','FieldController@addField');
Route::post('/deletefield','FieldController@delete');

Route::post('/changestatus','StudentController@changeStatus');

Route::get('/currentthesis','ThesisController@getCurrentThesis');
Route::post('/addcurrentthesis','ThesisController@addCurrentThesis');
