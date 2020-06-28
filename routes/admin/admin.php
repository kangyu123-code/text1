<?php
//后台路由
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
//登录显示
	Route::get('login','LoginController@index')->name('admin.login');
	Route::post('login','LoginController@login')->name('admin.login');
//muban路由

//后台界面
	Route::group(['middleware'=>['ckadmin']],function(){

	Route::get('index','IndexController@index')->name('admin.index');
	Route::get('logout','IndexController@logout')->name('admin.logout');
	Route::get('user/index','UserController@index')->name('admin.user.index');
	
//用户添加
	Route::get('user/add','UserController@create')->name('admin.user.create');
	Route::post('user/store','UserController@store')->name('admin.user.store');
	//删除用户
	Route::delete('user/del/{id}','UserController@del')->name('admin.user.del');
	//还原用户
	Route::get('user/reset/{id}','UserController@reset')->name('admin.user.reset');
	//修改用户
	Route::get('user/edit/{id}','UserController@edit')->name('admin.user.edit');
	//修改用户处理
	Route::put('user/update/{id}','UserController@update')->name('admin.user.update');
	//给用户分配角色
	Route::match(['get','post'],'user/role/{user}','UserController@role')->name('admin.user.role');
	//全选删除
	Route::delete('user/dall','UserController@dall')->name('admin.user.dall');
		//角色管理定义资源路由
	Route::resource('role','RoleController',['as'=>'admin']);
	//分配权限
	Route::get('role/node/{role}','RoleController@node')->name('admin.role.node');
	Route::post('role/node/{role}','RoleController@nodesave')->name('admin.role.nodesave');
	//节点管理
	Route::resource('node','NodeController',['as'=>'admin']);
	// 文件上传
	Route::post('article/upfile','ArticleController@upfile')->name('admin.article.upfile');
	//文章管理
	Route::resource('article','ArticleController',['as'=>'admin']);
	//房源属性
	Route::post('fangattr/upfile','FangAttrController@upfile')->name('admin.fangattr.upfile');
	Route::resource('fangattr','FangAttrController',['as'=>'admin']);
	//导出excel
	Route::get('fangOwner/exports','FangOwnerController@exports')->name('admin.fangOwner.exports');

	Route::get('fangOwner/delfile','FangOwnerController@delfile')->name('admin.fangOwner.delfile');
		// 删除图片的路由
	Route::post('fangOwner/upfile','FangOwnerController@upfile')->name('admin.fangOwner.upfile');

	Route::resource('fangOwner','FangOwnerController',['as'=>'admin']);
	//房源管理
	//获取市或县
	Route::get('fang/city','FangController@city')->name('admin.fang.city');
	//删除
	Route::get('fangOwner/delfile','FangOwnerController@delfile')->name('admin.fang.delfile');
	//上传
	Route::post('fang/upfile','FangController@upfile')->name('admin.fang.upfile');
	Route::resource('fang','FangController',['as'=>'admin']);
	});
	//邮件发送
	// Route::get('user/email',function(){
	// 	// \Mail::raw('你是撒比',function(\Illuminate\Mail\Message $message){
	// 	// 	$message->to('1286152917@qq.com','淆杂hng');
	// 	// 	$message->subject('测试邮件');
	// 	// });
	// 	\Mail::send('mail.adduser',['user'=>'抗御'],function(\Illuminate\Mail\Message $message){
	// 		// 发给谁
	// 		$message->to('1286152917@qq.com','淆杂hng');
	// 		// 主题
	// 		$message->subject('测试邮件');
	// 	});
	// });



});