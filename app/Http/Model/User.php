<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 18/11/2016
 * Time: 09:14
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;
}