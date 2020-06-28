@extends('admin.common.muban')
@section('main')
<section class="Hui-article-box">
	@include('admin.common.msg')
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		文章管理
		<span class="c-gray en">&gt;</span>
		 </nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c"> 
				<form method="get" onsubmit="return dopost()">
			
				
				<input type="text" class="input-text" style="width:250px" value="{{request()->get('title')}}" id="title" name="title">
				<button type="submit"  class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l"> 
					<a href="javascript:;" onclick="admin_add('添加文章','{{route("admin.article.create")}}','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加文章</a>
				</span>
				<span class="r">共有数据：<strong>{{$k}} </strong>条</span>
			</div>
			<table class="table table-border table-bordered table-bg">
				<thead>
					<tr>
						<th scope="col" colspan="9">文章列表</th>
					</tr>
					<tr class="text-c">
						
						<th width="40">ID</th>
						<th width="60">文章标题</th>
						<th width="150">文章摘要</th>
						<th width="150">封面</th>
						<th width="150">时间</th>
						<th width="100">操作</th>
					</tr>
				</thead>
			
			</table>
		</article>

	</div>
</section>
@endsection
@section('js')
<script type="text/javascript">
//列表显示
function dopost(){

	dataTable.ajax.reload();
	return false;
}
function del(obj){
		let url=$(obj).attr('href');
		fetch(url,{
			method:'delete',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			}

		}).then(res=>{
			return res.json();
		}).then(data=>{
			alert(data.msg);
			window.location.reload();
		})
		return false;
}
function sou(){
	let val=$('#lishiji').val();
	window.location.href="{{route('admin.role.index')}}?name="+val;
}
const _token="{{csrf_token()}}";

$('#kangyu').change(function(){
	$('.liwenshu').prop('checked',$('#kangyu').prop('checked'));
})
function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}



</script> 
<script type="text/javascript">
	var dataTable=$('.table-bg').DataTable({
		columnDefs:[
		{targets:[5],orderable:false}
		],
		serverSide:true,
		ajax:{
			url:'{{route("admin.article.index")}}',
			type:'get',
			data:function(res){
			
				res.datemin=$('#datemin').val();
				res.datemax=$('#datemax').val();
				res.title=$.trim($('#title').val());
			}

		},
		columns:[
		{data:'id'},
		{data:'title'},
		{data:'desn'},
		{data:'pic'},
		{data:'created_at'},
		{data:'action',defaultContent:'默认值'}
		],
		createdRow:function(row,data,dateIndex){
			var id=data.id;
			var td=$(row).find('td:last-child');
			var html=`<a href="/admin/article/${id}/edit" class="label label-secondary radius">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admin/article/${id}"
			 onclick="return del(this)" class="label label-warning radius">删除</a>`;

			td.html(html);
		}
	});
	
</script>
@endsection

<!--/请在上方写此页面业务相关的脚本-->
