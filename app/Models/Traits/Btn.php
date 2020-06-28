<?php
namespace App\Models\Traits;

trait Btn{
	public function editBtn(string $route)
	{

		if(auth()->user()->username!==env('SUPER')){
			if(!in_array($route, request()->auths)){
           return '';
           die();
        };
		return "<a href='javascript:;' onclick=\"admin_edit('管理员编辑','".route($route,$this)."','1','800','500')\" class=\"size-S btn btn-success\" style=\"text-decoration:none\">编辑</a> ";
		};

	} 
}
