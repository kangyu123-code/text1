<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Node;
class BaseController extends Controller
{
    //
    protected  $_pagesize=10;
    public function __construct(Request $request){
    	
    	$this->pagesize=config('page.pagesize');
        $this->middleware(function($request,$next){
            $data=session('admin.auth');
             $this->one($data);
            return $next($request);
        });

       
    }

    Public function one($data)
    {   
        $auth=$data;
      
        if(!is_array($auth)){
        $menuData=(new Node())->treedate($auth); 
       }else{
         $menuData=(new Node())->treedate(array_keys($auth)); 
       }
     	view()->share('menuData',$menuData);
    }
}
