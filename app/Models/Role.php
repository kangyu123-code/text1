<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
 protected $table= 'roles';
 //指定主键
 protected $primaryKey='id';
 protected $guarded=[];
  public $timestamps = FALSE;
  //角色与权限多对多
  public function nodes(){
  	return $this->belongsToMany(Node::class,'role_node','role_id','node_id');
  }
}
