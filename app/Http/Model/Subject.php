<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:10
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'bomon';
    public $incrementing = false;
    public $timestamps = false;
}