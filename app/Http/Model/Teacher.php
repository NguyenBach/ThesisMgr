<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:44
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'giangvien';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'teacherCode';
}