<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Fangattr extends Model
{
protected $guarded=[];

public function getList(){
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
}
