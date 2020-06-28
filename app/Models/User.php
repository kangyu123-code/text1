<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
//继承可以使用auth登录
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Btn;

class User extends AuthUser
{
    
    use SoftDeletes,Btn;
    //软删除标识字段
    protected $dates=['deleted_at'];
    protected $guarded=[];
    protected $rememberTokenName = '';
    public function role()
    {
    	return $this->belongsTo(Role::class,'role_id');
    }
  	
}
