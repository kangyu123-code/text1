<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    //
    public function index()
    {
    	if(auth()->check()){
    		return redirect(route('admin.index'));
    	}
    	return view('admin.login.login');
    }
     public function login(Request $request)
    {	
    	$post=$this->validate($request,[
    		'username'=>'required',
    		'password'=>'required'
    	],[
    		'username.required'=>'账号都不写想死吗'
    	]);

    	$boll=auth()->attempt($post);
    	if($boll){
            // 判读是否是超级管理员
            if(env('SUPER')!==$post['username']){
            $userModel=auth()->user();
            $roleModel=$userModel->role;
            $nodeid=$roleModel->nodes()->pluck('route_name','id')->toArray();
                session(['admin.auth'=>$nodeid]);//权限保存到session中
                session(['zhu'=>$post['username']]);//权限保存到session中
                session(['name'=>$roleModel['name']]);
            }else{
                session(['admin.auth'=>true]);
                session(['zhu'=>$post['username']]);
                session(['name'=>'超级管理员']);
                

            }
            
    		return redirect(route('admin.index'));
    	}else{
    		return redirect(route('admin.login'))->withErrors(['error'=>'登录失败']);
    	}
    }
    //登录
    	
    

}
