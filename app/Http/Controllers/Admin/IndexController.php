<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Node;
use App\Models\Fang;
class IndexController extends BaseController
{
    //
    public function index()

    {
        //读取
        $data=(new Fang())->fangshuju();
        
    	return view('admin.index.index',$data);
    }
      public function logout()
    {	//清空ssession
    	Auth::logout();
    	return redirect(route('admin.login'))->with('success','请重新登陆');
    }
}
