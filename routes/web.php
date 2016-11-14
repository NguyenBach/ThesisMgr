<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('student.index');
});
Route::get('/guest', function () {
    return view('guest.index');
});

Route::get('/admin',function (){
    return view('admin.index');
});
Route::get('/student',function (){
    return view('student.profile');
});
Route::get('/find',function (){
    return view('student.findteacher');
});
Route::get('/test','TestController@index');