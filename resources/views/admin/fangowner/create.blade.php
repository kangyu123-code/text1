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
	<form class="form form-horizontal" id="form-admin-add" action="{{route('admin.fangOwner.store')}}" method="post">
		@csrf
<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>姓名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="name" >
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>年龄：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="age" >
			</div>
		</div>

	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="sex" type="radio" id="sex-1"  value="男">
					<label for="sex-1">男</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" value="女" name="sex">
					<label for="sex-2">女</label>
				</div>
			</div>
		</div>

<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="phone" >
			</div>
		</div>


<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="email" >
			</div>
		</div>

<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="card" >
			</div>
		</div>

<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证号：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="card" >
			</div>
		</div>


		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>身份证照片：</label>
			<div class="formControls col-xs-8 col-sm-5">
				<div id="picker">身份证照片</div>
				<span>正面，手持，反面</span>
				
			</div>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="hidden" class="input-text"  id="pc" name="pic" >
				<div id="imglist" style="margin-left: 200px;width:300px;display: flex;justify-content: space-between;">
					


				</div>
				
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="添加房东" >
			</div>
		</div>
	</form>
		
</article>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/webupload/webuploader.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--/请在上方写此页面业务相关的脚本-->
</body>
   <script type="text/javascript">
   	 var uploader = WebUploader.create({
    // swf文件路径
    	auto:true,
 
  	  swf: '/webupload/Uploader.swf',
  	  formData:{
  	  	_token:'{{csrf_token()}}',

  	  },
    server: "{{route('admin.fangOwner.upfile')}}",
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
let url="{{route('admin.fangOwner.delfile')}}?file="+picurl;
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