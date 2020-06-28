<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<style type="text/css">
	#imglist{
position: relative;
}
#imglist strong{
	right: 2px;
	top:2px;
	color: #000;
	font-size: 20px;
}

.table .text-c td{
	vertical-align: middle;
}
</style>
</head>
<body>
<article class="cl pd-20" id="app">
	@include('admin.common.validate')
	<form class="form form-horizontal" id="form-admin-add" action="{{route('admin.fang.store')}}" method="post">
		@csrf
<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房源名称：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" value="" placeholder="" id="adminName" name="fangname" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>小区名称：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" value="" placeholder="" id="adminName" name="fang_xiaoqu" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>小区地址：</label>
	<div class="formControls col-xs-5 col-sm-6">
		 <span class="select-box" style="width:100px;">
		<select class="select" name="pid" size="1" onchange="select_city(this,'fang_city')">
		<option value="0">请选择省</option>			
					@foreach($data['citedata'] as $item)
	<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
		</span>

		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_city" name="fang_city" size="1" onchange="select_city(this,'fang_region')">
					<option value="0">==市==</option>
				</select>
		</span>

		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_region" name="fang_region" size="1">
				<option value="">==区==</option>
				</select>
		</span>
	</div>
	<div class="formControls col-xs-3 col-sm-3">
		<input type="text" class="input-text" value="" placeholder="小区详细地址和信息" id="adminName" name="fang_addr" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租金：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" value="" placeholder="" id="adminName" name="fang_rent" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>楼层：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="text" class="input-text" value="" placeholder="" id="adminName" name="fang_floor" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>付款方式：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_region" name="fang_region" size="1">
					@foreach($data['fang_rent_data'] as $item)
				<option value="{{$item->id}}">{{$item->name}}</option>
				@endforeach
				</select>
		</span>
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>几室：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="1" placeholder="" id="adminName" name="fang_shi" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>几厅：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="1" placeholder="" id="adminName" name="fang_ting" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>几卫：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="1" placeholder="" id="adminName" name="fang_wei" >
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>朝向：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_direction" name="fang_direction" size="1">
					@foreach($data['fang_direction_data'] as $item)
				<option value="{{$item->id}}">{{$item->name}}</option>
				@endforeach
				</select>
		</span>
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>租赁方式：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_rent_class" name="fang_rent_class" size="1">
					@foreach($data['fang_rent_class_data'] as $item)
				<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
		</span>
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>建筑面积：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="60" placeholder="" id="adminName" name="fang_build_area" >平米
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>使用面积：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="12" placeholder="" id="" name="fang_using_area" >平
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>建筑年代：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<input type="number" class="input-text" value="2016" placeholder="" id="" name="fang_year" >年
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>配套设施：</label>
	<div class="formControls col-xs-8 col-sm-9">
		@foreach($data['fang_config_data'] as $item)
			<label>
				<input type="checkbox" name="fang_config[]" value="{{$item->id}}">{{$item->name}}&nbsp;&nbsp;&nbsp;&nbsp;
			</label>
		@endforeach
	</div>
</div>


<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋照片：</label>
	<div class="formControls col-xs-8 col-sm-5">
		<div id="picker">房屋照片</div>
		</div>
		<div class="formControls col-xs-8 col-sm-5">
			<input type="hidden" class="input-text"  id="fang_pic" name="fang_pic" >
			<!-- 表单提交上传图片地址以#好隔开 -->
			<div id="imglist" style="margin-left: 200px;width:300px;display: flex;justify-content: space-between;">
				<!-- //显示上传后的容器 -->
				<div id="imglist"></div>
			</div>
		</div>
	</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>业主：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<span class="select-box" style="width:100px;">
				<select class="select" id="fang_owner" name="fang_owner" size="1">
					@foreach($data['ownerdate'] as $item)
				<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
		</span>
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否推荐：</label>
	<div class="formControls col-xs-8 col-sm-9 skin-minimal">
		<div class="radio-box">
			<input name="is_recommend" type="radio" id="sex-1" checked="" value="1">
			<label for="sex-1">是</label>
		</div>
		<div class="radio-box">
			<input type="radio" id="sex-2" value="0" name="is_recommend">
			<label for="sex-2">否</label>
		</div>
	</div>
</div>

<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋详情：</label>
	<div class="formControls col-xs-8 col-sm-9">
	<textarea  cols="60" rows="10" id="container" name="fang_body">	请输入房屋详情</textarea>
	</div>
</div>
		
<div class="row cl">
	<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>房屋描述：</label>
	<div class="formControls col-xs-8 col-sm-9">
		<textarea  cols="70" rows="5" id="container" name="fang_desn"></textarea>
	</div>
</div>

<div class="row cl">
	<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
		<input class="btn btn-primary radius" type="submit" value="添加房源" >
	</div>
	</div>
</form>
		
</article>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
  <script type="text/javascript" src="/ed/ueditor.config.js"></script>
  <script type="text/javascript" src="/ed/ueditor.all.js"></script>
<script type="text/javascript" src="/webupload/webuploader.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--/请在上方写此页面业务相关的脚本-->
</body>
   <script type="text/javascript">
   // 下拉选择
   function select_city(obj,selectname){
   		let value=$(obj).val();
   		$.get("{{route('admin.fang.city')}}",{id:value}).then(jsonarr=>{
   			let htmls=`<option value="0">市</option>`;
   			jsonarr.map(item=>{
   				var {id,name}=item;
   				htmls+=`<option value="${id}">${name}</option>`;
   				});
   			$('#'+selectname).html(htmls);
   		})
   }


 	  var ue = UE.getEditor('container',{
        	// initialFrameHeight:400
        });

   	 var uploader = WebUploader.create({
    // swf文件路径
    	auto:true,
 
  	  swf: '/webupload/Uploader.swf',
  	  formData:{
  	  	_token:'{{csrf_token()}}',

  	  },
    server: "{{route('admin.fang.upfile')}}",
    pick: '#picker',
    resize: false
		});
// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadSuccess', function( file ,ret) {
    // let src=ret.url;
    // $('#icon').val(src);
    // $('#pic').css('opacity',1);
    // $('#pic').attr('src',src);
    let val=$('#pc').val();
    let tmp=val+'#'+ret.url;
    $('#pc').val(tmp);
    let imglist=$('#imglist');
    let html=`<div>
    		<img width="40" height="40" src="${ret.url}"/>
    		<strong onclick="del(this,'${ret.url}')">X</strong>
    </div>`
    imglist.append(html);
});
function del(obj,picurl){
let url="{{route('admin.fang.delfile')}}?file="+picurl;
	// 发起请求
	fetch(url);
	//删除当前电机的图片
	$(obj).parent('div').remove();
	let kangyu=$('#pc').val().replace(`#${picurl}`,'');
	alert(kangyu);
	$('#pc').val(kangyu);
}
   </script>
</html>