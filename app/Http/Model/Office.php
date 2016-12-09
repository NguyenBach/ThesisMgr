<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:51
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $table = "vpk";
    public $incrementing = false;
    public $timestamps = false;
}