<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Fang extends Model
{
    // 修改器
    public function setFangConfigAttribute($value){
    	$this->attributes["fang_config"]=implode(',', $value);
    }
    public function setFangPicAttribute($value){
    	$this->attributes["fang_pic"]=trim($value,'#');
    }

    protected $guarded=[];
    use SoftDeletes;
    //属于关系
    public function owner(){
    return $this->belongsTo(FangOwner::class,'fang_owner');

    }
    public function attr(){
    	return $this->belongsTo(Fangattr::class,'fang_direction');

    }
     public function atts(){
    	return $this->belongsTo(Fangattr::class,'fang_rent_class');

    }
 		public function cites(){
    	return $this->belongsTo(Fangattr::class,'fang_province');
	    }

    //添加和修改关联数据
    public function relation()
    {
    	$ownerdate=FangOwner::get();
        //省份的获取
        $citedata=Cite::where('pid',0)->get();
        //租期方式
        $fang_rent_id=Fangattr::where('field_name','fang_rent_type')->value('id');
        $fang_rent_data=Fangattr::where('pid',$fang_rent_id)->get();
        //朝向
         $fang_direction_id=Fangattr::where('field_name','fang_direction')->value('id');
        $fang_direction_data=Fangattr::where('pid',$fang_direction_id)->get();
        //租赁方式
          $fang_rent_class_id=Fangattr::where('field_name','fang_rent_class')->value('id');
        $fang_rent_class_data=Fangattr::where('pid',$fang_rent_class_id)->get();
        //配套设施
        $fang_config_id=Fangattr::where('field_name','fang_config')->value('id');
        $fang_config_data=Fangattr::where('pid',$fang_config_id)->get();
        return [
        	'ownerdate'=>$ownerdate,
        	'citedata'=>$citedata,
        	'fang_rent_data'=>$fang_rent_data,
        	'fang_direction_data'=> $fang_direction_data,
        	'fang_rent_class_data'=>$fang_rent_class_data,
        	'fang_config_data'=> $fang_config_data
        ];
    }
    //统计已出租和未出租数据
public function fangshuju()
{
	$total=self::count();
	$wei=self::where('fang_status',0)->count();
	$yi=$total-$wei;
	return [
		'total'=>$total,
		'wei'=>$wei,
		'yi'=>$yi
	];
}
//房源图片的处理
public function getImagesAttribute()
{
	$arr=explode('#',$this->attributes['fang_pic']);
	$html="";
	if(!empty($arr)){
	foreach ($arr as $k => $v) {
	$html.="<div><img width='40' height='40' src='$v'/>
    		<strong class='kangyu' href='$v'>X</strong>
    </div>";
	}
	}
	return $html;
}


}
