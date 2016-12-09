<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:48
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = "khoahoc";
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'code';
}