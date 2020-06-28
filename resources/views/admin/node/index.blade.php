@extends('admin.common.muban')
@section('main')
<section class="Hui-article-box">
	@include('admin.common.msg')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		角色管理
		<span class="c-gray en">&gt;</span>
		 </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 
			
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> 
					<a href="javascript:;" onclick="admin_add('添加权限','{{route("admin.node.create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限</a>
				</span>
				<span class="r">共有数据：<strong>{{$k}} </strong>条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="9">员工列表</th>
					</tr>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value="" id="kangyu"></th>
						<th width="40">ID</th>
						<th width="150">节点名称</th>
						<th width="150">路由别名</th>
						<th width="150">是否菜单</th>
						
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr class="text-c">

						<td>
					
						<input type="checkbox" value="{{$item['id']}}" name="id[]" class="liwenshu">
						
						</td>
						<td>{{$item['id']}}</td>
						<td>{{$item['name']}}</td>
						<td>{{$item['html']}}{{$item['route_name']}}</td>
						<td>{{$item['is_menu']?'是':'否'}}</td>
						<td>

		<a href="javascript:;" onclick="admin_edit('管理员编辑','{{route('admin.role.edit',['id'=>$item['id']])}}','1','800','500')" class="size-S btn btn-success" style="text-decoration:none">编辑
	</a> 
	
	<a onclick="del(this,'{{route('admin.node.destroy',['id'=>$item['id']])}}')"class="size-S ml-5 	btn btn-danger radius" style="text-decoration:none">删除</a>
	</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</article>

	</div>
</section>
@endsection
@section('js')
<script type="text/javascript">

function sou(){
	let val=$('#lishiji').val();
	window.location.href="{{route('admin.role.index')}}?name="+val;
}
const _token="{{csrf_token()}}";

$('#kangyu').change(function(){
	$('.liwenshu').prop('checked',$('#kangyu').prop('checked'));
})
/*

	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/

function del(obj,url){
	layer.confirm('确认要删除吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			url,
			type:'delete',
			data:{_token},
			dateType:'json',
		}).then(({status,msg})=>{
			if(status==0){
			$(obj).parents("tr").remove();	
			layer.msg(msg,{icon:1,time:1000},function(){
							location.reload();
			});
			}else{
				layer.alert('你没有权限 ',{icon:2});
			}

		})

		
	});
}
function reset(obj,url){

	layer.confirm('确认要还原吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			url,
			type:'get',
			dateType:'json',
		}).then(({status,msg})=>{
			if(status==0){

			layer.msg(msg,{icon:1,time:1000},function(){
					location.reload()
			});
			}
		})

		
	});
}
/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/

</script> 
@endsection

<!--/请在上方写此页面业务相关的脚本-->
