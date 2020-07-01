<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 房源信息表
     */
    public function up()
    {
        Schema::create('fangs', function (Blueprint $table) {
            $table->increments('id');
             $table->string('fang_name',100)->default('')->comment('房源名称');
    $table->string('fang_xiaoqu',100)->default('')->comment('房源小区名称');
    $table->unsignedInteger('fang_province')->default(0)->comment('省');
    $table->unsignedInteger('fang_city')->default(0)->comment('市');
    $table->unsignedInteger('fang_reg')->default(0)->comment('区');
    $table->string('fang_addr',200)->default('')->comment('房源地址');
    $table->unsignedInteger('fang_direction')->default(0)->comment('房源朝向');
    $table->unsignedInteger('fang_build_area')->default(0)->comment('房源面积');
    $table->unsignedInteger('fang_using_area')->default(0)->comment('使用面积');
    $table->unsignedInteger('fang_year')->default(2000)->comment('建筑年代');
    $table->unsignedInteger('fang_rent')->default(0)->comment('租金');
    $table->unsignedTinyInteger('fang_floor')->default(1)->comment('楼层');
    $table->unsignedTinyInteger('fang_shi')->default(1)->comment('几室');
    $table->unsignedTinyInteger('fang_ting')->default(1)->comment('几厅');
    $table->unsignedTinyInteger('fang_wei')->default(1)->comment('几卫');
    $table->string('fang_pic',500)->default('')->comment('房屋图片');
    $table->unsignedInteger('fang_rent_class')->default(0)->comment('租赁方式');
    $table->string('fang_config',100)->default('')->comment('配套设施');
    $table->unsignedInteger('fang_area')->default(0)->comment('区域');
    $table->unsignedInteger('fang_rent_range')->default(0)->comment('租金范围');
    $table->unsignedInteger('fang_rent_type')->default(0)->comment('租期方式');
     $table->unsignedInteger('fang_status')->default(0)->comment('房源状态');
    $table->unsignedInteger('fang_owner')->default(0)->comment('业主');
    $table->string('fang_desn',500)->default('')->comment('房源描述');
$table->text('fang_body')->comment('房源信息');
$table->unsignedInteger('fang_group')->default(0)->comment('租房小组');
$table->enum('is_recommend',['0','1'])->default('0')->comment('是否推荐:0否，1是');
$table->decimal('latitude',10,6)->default(0)->comment('纬度');
$table->decimal('longitude',10,6)->default(0)->comment('经度');
    $table->timestamps();
    // 软删除
    $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fangs');
    }
}
