@extends('admin.common.muban')
@section('main')

<section class="Hui-article-box">
	@include('admin.common.msg')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		房源管理
		<span class="c-gray en">&gt;</span>
		 </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 
			
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> 
					<a href="javascript:;" onclick="admin_add('添加房源','{{route("admin.fang.create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加房源属性</a>
<a href="#" class="btn btn-success radius"><i class="Hui-iconfont">&#xe600;</i> 导出excel</a>
				</span>
				<span class="r">
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="14">房源列表</th>
					</tr>
					<tr class="text-c">
						<th width="40">ID</th>
						<th width="40">房源名称</th>
						<th width="150">小区名称</th>
						<th width="150">小区地址</th>
						<th width="60">租赁方式</th>
						<th width="40">业主</th>
						<th width="150">租金</th>
						<th width="40">朝向</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr class="text-c">
						<td>{{$item['id']}}</td>
						<td>{{$item['fang_name']}}</td>
						<td>{{$item['fang_xiaoqu']}}</td>
						<td>{{$item['fang_addr']}}</td>
						<td>{{$item['atts']['name']}}</td>
						<td>{{$item['owner']['name']}}</td>
						<td>{{$item['fang_rent']}}</td>
						<td>{{$item['attr']['name']}}</td>
						<td style="display: flex;justify-content: space-between;height: 58px;align-items: center;">
		<a href="javascript:;" onclick="admin_edit('编辑','{{route('admin.fang.edit',['id'=>$item['id']])}}','1','600','400')" class="btn btn-success size-MINI" style="text-decoration:none">编辑
	</a> 
		<a href="javascript:;" onclick="admin_edit('查看照片','{{route('admin.fang.show',['id'=>$item['id']])}}','1','800','500')" class="btn btn-warning radius size-MINI" style="text-decoration:none">查看照片</a>

	<a onclick="del(this,'{{route('admin.fang.destroy',['id'=>$item['id']])}}')"class="size-MINI 	btn btn-danger radius" style="text-decoration:none">删除</a>
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
				layer.alert('你没有房源 ',{icon:2});
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
