<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:44
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'donvi';
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'teacherCode';
}