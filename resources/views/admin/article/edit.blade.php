<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="/webupload/webuploader.css">
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<!--[if IE 6]>
<script type="text/javascript" src="http:///admin/lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->

</head>
<body>
<article class="cl pd-20" id="app">
	<form class="form form-horizontal" action="{{route('admin.article.update',$article)}}" id="form-admin-add" ref="frm" >
		@csrf

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="title" v-model="info.title">
			</div>
		</div>
	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="desn" v-model="info.desn">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章封面：</label>
			<div class="formControls col-xs-8 col-sm-9">
    			<input type="hidden" name="pic" id="pic" :value="info.pic"> 
    		    <div id="picker">选择文件</div><img id="img" width="50" height="50" :src="info.pic">
    		</div>
		</div>

			</div>
		</div>
		
		
	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
			<textarea cols="70" rows="10" name="body" id="container" v-model="info.body"></textarea>
			</div>
		</div>
	
	</form>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" @click="dopost" value="提交" >
			</div>
		</div>
</article>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/webupload/webuploader.js"></script>
  <script type="text/javascript" src="/ed/ueditor.config.js"></script>
  <script type="text/javascript" src="/ed/ueditor.all.js"></script>


<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
	new Vue({
		el:'#app',
		data:{
			info:{!!$article!!}
		},
		methods:{
			async dopost(){
				//获取内容
			this.info.body=this.editor.getContent()
				// var frmData=new FormData(this.$refs.frm);
				 var frmData=JSON.stringify(this.info);
				let ret=await fetch(this.$refs.frm.action,{
					method:'put',
					body:frmData,
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}',
						'Content-Type':'application/json'
					},
					body:frmData
				
				});
				let json=await ret.json();
				location.href=json.url;
			}
		},
		mounted(){
		 this.editor= UE.getEditor('container',{

        });
		 this.editor.addListener("ready",()=>{
		 	this.editor.setContent(this.info.body)
		 });
		this.uploader = WebUploader.create({swf:'/webupload/Uploader.swf',auto:true,pick:'#picker',  formData:{
  	  	_token:'{{csrf_token()}}',
  	  	resize: false
  	  },
    server: "{{route('admin.article.upfile')}}",});
		this.uploader.on( 'uploadSuccess', ( file,ret )=>{
			let src=ret.url;
			this.info.pic=src;
		});
		}
	})


</script>

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>