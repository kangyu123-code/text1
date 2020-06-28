<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Btn;
class Article extends Model
{
    //
 protected $table= 'articles';
 //指定主键

 protected $primaryKey='id';
 protected $guarded=[];

  use SoftDeletes,Btn;
 


}
