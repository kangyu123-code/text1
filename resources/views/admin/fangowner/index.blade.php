@extends('admin.common.muban')
@section('main')

<section class="Hui-article-box">
	@include('admin.common.msg')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		房东管理
		<span class="c-gray en">&gt;</span>
		 </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 
			
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> 
					<a href="javascript:;" onclick="admin_add('添加房东','{{route("admin.fangOwner.create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加房东属性</a>
<a href="{{route('admin.fangOwner.exports')}}" class="btn btn-success radius"><i class="Hui-iconfont">&#xe600;</i> 导出excel</a>
				</span>
				<span class="r">共有数据：<strong>{{$k}} </strong>条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="14">房东列表</th>
					</tr>
					<tr class="text-c">
						<th width="40">ID</th>
						<th width="40">姓名</th>
						<th width="150">身份证号</th>
						<th width="150">身份照片</th>
						<th width="40">性别</th>
						<th width="40">年龄</th>
						<th width="150">手机</th>
						<th width="150">邮箱</th>
						<th width="150">地址</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr class="text-c">
						<td>{{$item['id']}}</td>
						<td>{{$item['name']}}</td>
						<td>{{$item['card']}}</td>
						<td>照片</td>
						<td>{{$item['sex']}}</td>
						<td>{{$item['age']}}</td>
						<td>{{$item['phone']}}</td>
						<td>{{$item['email']}}</td>
						<td>{{$item['address']}}</td>
						<td style="display: flex;justify-content: space-between;height: 58px;align-items: center;">
		<a href="javascript:;" onclick="admin_edit('编辑','{{route('admin.fangOwner.edit',['id'=>$item['id']])}}','1','600','400')" class="btn btn-success size-MINI" style="text-decoration:none">编辑
	</a> 
		<a href="javascript:;" onclick="admin_edit('查看照片','{{route('admin.fangOwner.show',['id'=>$item['id']])}}','1','800','500')" class="btn btn-warning radius size-MINI" style="text-decoration:none">查看照片</a>

	<a onclick="del(this,'{{route('admin.fangOwner.destroy',['id'=>$item['id']])}}')"class="size-MINI 	btn btn-danger radius" style="text-decoration:none">删除</a>
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
				layer.alert('你没有房东 ',{icon:2});
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
