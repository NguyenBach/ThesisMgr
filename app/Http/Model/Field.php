<?php
/**
 * Created by PhpStorm.
 * User: quangbach
 * Date: 09/11/2016
 * Time: 20:49
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'linhvuc';
    public $incrementing = false;
    public $timestamps = false;
}