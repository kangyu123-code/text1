@extends('admin.common.muban')
@section('main')
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a> 
		<span class="c-999 en">&gt;</span>
		<span class="c-666">我的桌面</span> 
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<p class="f-20 text-success">欢迎使用H-ui.admin
				<span class="f-14">v2.3</span>
				后台模版！</p>
			<p>登录次数：18 </p>
			<p>上次登录IP：{{request()->ip()}}</p>
			<p>图表</p>
	<div id="main" style="width: 600px;height:400px;"></div>

</article>
		<footer class="footer">
			<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
</footer>
</div>
</section>

@endsection
@section('js')
<script type="text/javascript" src="/js/echarts.min.js"></script>
 <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
   option = {
    title: {
        text: '房屋出租',
        subtext: '已租和未租',
        left: 'center'
    },
    tooltip: {
        trigger: 'item',
        formatter: '{a} <br/>{b} : {c} ({d}%)'
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['已租', '未租']
    },
    series: [
        {
       
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
                {value: {{$yi}}, name: '已租'},
                {value: {{$wei}}, name: '未租'},
                
            ],
           
        }
    ]
};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection