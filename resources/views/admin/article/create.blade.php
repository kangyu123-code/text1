<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http:///admin/lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->
<style type="text/css">
	#img{
		width: 40vh;
		height: 40vh;
		opacity: 0;
	}
</style>
<title>添加文章 H-ui.admin v3.0</title>
</head>
<body>
<article class="cl pd-20">
	@include('admin.common.validate')
	<form action="{{route('admin.article.store')}}" method="post"  class="form form-horizontal" id="form-admin-add">
		@csrf
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="title">
			</div>
		</div>
		
			<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="desn">

			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章封面：</label>
			<div class="formControls col-xs-8 col-sm-9">
		
				     <div id="uploader" class="wu-example">
    		<div id="thelist" class="uploader-list"></div>
    		<div class="btns">
    			<input type="hidden" name="pic" id="pic"> 
    		    <div id="picker">选择文件</div><img id="img" >
    		</div>
			</div>

			</div>
		</div>	

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea cols="30" rows="10" name="body" id="container"></textarea>
			</div>
		</div>
	
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<script type="text/javascript" src="/webupload/webuploader.js"></script>
  <script type="text/javascript" src="/ed/ueditor.config.js"></script>
  <script type="text/javascript" src="/ed/ueditor.all.js"></script>
<!--/_footer /作为公共模版分离出去-->
<script type="text/javascript">
        var ue = UE.getEditor('container',{
        	// initialFrameHeight:400
        });
        
     //上传

   </script>
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

    // 文件接收服务端。
    server: "{{route('admin.article.upfile')}}",
    //文件上传的参数
 
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#picker',

    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    resize: false
		});


   
// 完成上传完了，成功或者失败，先删除进度条。
uploader.on( 'uploadSuccess', function( file ,ret) {
    let src=ret.url;
    $('#pic').val(src);
    $('#img').css('opacity',1);
    $('#img').attr('src',src);
});

   </script>
<!--请在下方写此页面业务相关的脚本-->

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>