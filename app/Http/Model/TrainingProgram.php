<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:42
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $table = 'chuongtrinhdaotao';
    public $timestamps = false;
    public $primaryKey = 'code';
    public $incrementing = false;
}