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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="http:///admin/lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->

</head>
<body>
<article class="cl pd-20" id="app">
	<form class="form form-horizontal" id="form-admin-add" >
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>节点名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="name" v-model="info.name">
			</div>
		</div>
	<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由别名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="adminName" name="name" v-model="info.route_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否菜单：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="info.is_menu" type="radio" id="sex-1" value="0" v-model="info.is_menu">
					<label for="sex-1">否</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" value="1" name="info.is_menu" v-model="info.is_menu">
					<label for="sex-2">是</label>
				</div>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">是否顶级：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="pid" size="1" @change="chnagepid">
					<option value="0">==顶级==</option>
					@foreach($data as $item)
						<option value="{{$item->id}}">{{$item->name}}</option>
					@endforeach
				</select>
				</span> </div>
		</div>
	
	
	</form>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="提交" @click="dopost">
			</div>
		</div>
</article>
<!--_footer 作为公共模版分离出去-->

<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
	new Vue({
		el:'#app',
		data:{
			info:{
				_token:"{{csrf_token()}}",
				pid:0,
				name:'',
				route_name:'',
				is_menu:1,	
			}
		

		},
		methods:{
		 dopost(event){

			 $.post('{{route("admin.node.store")}}',this.info).then(({status,msg})=>{
			 	if(status==0){
			 		alert(msg);
			 		window.parent.location.reload();
			 	}else{
			 		alert(msg);
			 	}
			 })	
			},
			// 下拉
			chnagepid(evt){
				
				this.info.pid=evt.target.value||0;
			}
		}
	})

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>