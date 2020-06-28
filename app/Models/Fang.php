<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Fang extends Model
{
    //
    use SoftDeletes;
    //属于关系
    public function owner(){
    	return $this->belongsTo(FangOwner::class,'fang_owner');

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
}
