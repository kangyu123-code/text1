<!--_meta 作为公共模版分离出去-->
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

</head>
<body>
<article class="cl pd-20" id="app">
	@include('admin.common.validate')
	<form class="form form-horizontal" id="form-admin-add" action="{{route('admin.fangattr.update',$fangattr)}}" method="post">
		@csrf
		@method('PUT')
<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">是否顶级：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="pid" size="1">
					<option value="0" @if($fangattr->pid==0)selected @endif>==顶级==</option>
					@foreach($data as $item)
						<option value="{{$item->id}}" @if($fangattr->pid==$item->id) selected @endif>{{$item->name}}</option>
					@endforeach
				</select>
				</span> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>属性名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$fangattr->name}}" placeholder="" id="adminName" name="name" >
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>属性图标：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="hidden" class="input-text" value="{{$fangattr->icon}}"  id="icon" name="icon" >
				<div id="picker">选择文件</div>
				<img id="pic" src="{{$fangattr->icon}}" width="40" height="40">
			</div>
		</div>

	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>字段名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$fangattr->field_name}}" placeholder="" id="adminName" name="field_name" >
			
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="修改属性" >
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
    pick:{
    	multiple:false,
    },
  	  swf: '/webupload/Uploader.swf',
  	  formData:{
  	  	_token:'{{csrf_token()}}',

  	  },
    server: "{{route('admin.fangattr.upfile')}}",
    pick: '#picker',
    resize: false
		});



   
// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadSuccess', function( file ,ret) {
    let src=ret.url;
    $('#icon').val(src);
    $('#pic').css('opacity',1);
    $('#pic').attr('src',src);
});

   </script>
</html>