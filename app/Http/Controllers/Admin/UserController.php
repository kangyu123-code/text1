<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Mail\Message;
use Mail;
use App\Models\Role;
use App\Models\Node;
//是否是对应的
use Hash;
class UserController extends BaseController
{
    //
   
    public function index(){
      
    	$data=User::orderBy('id','asc')->withTrashed()->paginate(config($this->_pagesize));
        
    	return view('admin.user.index',compact('data'));
    }

     public function create(){
    
    	return view('admin.user.create');
    }

     public function store(Request $request){
 		$this->validate($request,[
 			'username'=>'required|unique:users,username',
 			'password'=>'required|confirmed',
 			'phone'=>'required',
 			]);
 			$pt=$request->except('_token','password_confirmation');
 			$pwd=$pt['password'];
 			$post=User::create($pt);
 			
 			//发邮件给用户
 			Mail::send('mail.useradd',compact('post','pwd'),function($message) use ($post){
			// 发给谁
			$message->to($post->email);
			// 主题
			$message->subject('添加用户邮件通知');
			});

 			//跳转
 			return  redirect(route('admin.index'))->with('success','添加用户成功');
    }
    public function del(int $id)
    {
    	User::find($id)->delete();
    	return ['status'=>0,'msg'=>'删除成功'];
    }
     public function reset(int $id)
    {
    	User::onlyTrashed()->where('id',$id)->restore();
    	return ['status'=>0,'msg'=>'还原成功'];
    }

       public function dall(Request $request)
    {	
    	
    	$ids=$request->get('id');
    	
    	User::destroy($ids); 
    	  return ['status'=>0,'msg'=>'全选删除成功'];
    }
    //修改显示
    public function edit(int $id)
    {  
        $model=User::find($id);
        return view('admin.user.edit',compact('model'));
    }
    //修改处理
        public function update(Request $request,int $id)
    {
          
        $model=User::findOrFail($id);
        //原密码
        $spass=$request->get('spassword');
        
        $old=$model->password;
        $bool=Hash::check($spass,$old);
        if($bool){
            $data=$request->only([
                'username',
                'id',
                'password',
                'phone',
                'sex',
                'email'
            ]);

            $data['password']=bcrypt($data['password']);
            $model->update($data);
            return redirect(route('admin.user.edit',$model))->with([
                'success'=>'修改用户成功'
            ]);
        }else{
            return redirect(route('admin.user.edit',$model))->withErrors([
                'errors'=>'原密码不正确']);
        }
        
    }
    public function role(Request $request,User $user)
    {
      
        if($request->isMethod('post')){
            $post=$this->validate($request,[
                'role_id'=>'required'
            ],['role_id.required'=>'必须选择']);
            $user->update($post);
            return redirect(route('admin.user.index'));
        }else{
            //读取所有角色
            $roleall=Role::all();
            return view('admin.user.role',compact('user','roleall'));
        }
    }
}
