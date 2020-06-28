<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //
 protected $table= 'nodes';
 //指定主键
 protected $primaryKey='id';
 protected $guarded=[];
  public $timestamps = FALSE;
  //访问器
  // public function getIsMenuAttribute()
  // {
  // 	return 'a';
  // }
  public function getalllist(){
  	$data=self::get()->toArray();
  	return $this->treelevel($data);
  }
  function treelevel(array $data,int $pid=0,string $html='--',int $level=0)
  {
  	static $arr=[];
  	foreach ($data as $val) {
  		if($pid==$val['pid']){
  		$val['html']=str_repeat($html, $level*2);
  		$val['level']=$level+1;
  		$arr[]=$val;
  		$this->treelevel($data,$val['id'],$html,$val['level']);
  	}
  }
  	return $arr;
  
}
// 用户有的权限
public function treedate($data)
{
      if(!is_array($data)){
        $menuData=Node::where('is_menu','1')->get()->toArray();
      }else{
         $menuData=Node::where('is_menu','1')->whereIn('id',$data)->get()->toArray();
      }
     
      return $this->subtree($menuData);
}
  function subtree(array $data,int $pid=0,string $html='--',int $level=0)
  {
     $arr=[];
    foreach ($data as $val) {
      if($pid==$val['pid']){
        $val['sub']=$this->subtree($data,$val['id']);
        $arr[]=$val;
    }
  }
    return $arr;
  
}


}