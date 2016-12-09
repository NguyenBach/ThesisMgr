<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:46
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'hocvien';
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'studentCode';
}