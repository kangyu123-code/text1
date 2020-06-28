@extends('admin.common.muban')
@section('main')
<section class="Hui-article-box">
	@include('admin.common.msg')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a> </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 
				<input type="text" class="input-text" style="width:250px" placeholder="输入管理员名称" id="" name="">
				<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','{{route("admin.user.create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a> </span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="10">员工列表</th>
					</tr>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value="" id="kangyu"></th>
						<th width="40">ID</th>
						<th width="100">用户名</th>
						<th class="class="label label-success radius" " width="100">角色名</th>
						<th width="40">性别</th>
						<th width="90">手机</th>
						<th width="150">邮箱</th>
						<th width="130">加入时间</th>
						<th width="100">状态</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr class="text-c">

						<td>
						@if(auth()->id()!=$item->id)
						@if($item->deleted_at==null)
						<input type="checkbox" value="{{$item->id}}" name="id[]" class="liwenshu">
						@endif
						@endif
						</td>
						<td>{{$item->id}}</td>

						<td>{{$item->username}}</td>
						<td>{{$item->role->name}}</td>
						<td>{{$item->sex}}</td>
						<td>{{$item->phone}}</td>
						<td>{{$item->email}}</td>
						<td>{{$item->created_at}}</td>

						<td class="td-status"><a href="{{route('admin.user.role',$item)}}" class="label label-success radius">角色分配</a></td>

<td class="td-manage">
	{!!$item->editBtn('admin.user.edit')!!}

	@if(auth()->id()!=$item->id)
		@if($item->deleted_at!=null)
		<a onclick="reset(this,'{{route('admin.user.reset',['id'=>$item->id])}}')"class="size-S ml-5 btn btn-primary radius" style="text-decoration:none">还原</a>
		@else
	<a onclick="del(this,'{{route('admin.user.del',['id'=>$item->id])}}')"class="size-S ml-5 	btn btn-danger radius" style="text-decoration:none">删除</a>
		@endif
	@endif
	</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</article>
		{{$data->links()}}
	</div>
</section>
@endsection
@section('js')
<script type="text/javascript">
const _token="{{csrf_token()}}";
function datadel(){
	let ids=$('.liwenshu:checked');
	let id=[];
	$.each(ids,function(k,v){
		id.push($(v).val());
	})
	if(id.length>0){
		layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			url:"{{route('admin.user.dall')}}",
			type:'delete',
			data:{id,_token},
			dateType:'json',
		}).then(({status,msg})=>{
			if(status==0){
			layer.msg(msg,{icon:1,time:1000},function(){
							location.reload();
			});
			}
		})
			});
	}
	}
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
