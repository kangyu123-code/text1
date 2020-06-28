<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Node;
class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                    
        $name=$request->get('name');
        $data=Role::when($name,function($query) use ($name){
            $query->where('name','like',"%{$name}%");
        })->get();
        $data->total=Role::count();
       
        return view('admin.role.index',compact('data','name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加显示

        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加处理

        try{
              $this->validate($request,[
            'name'=>'required|unique:roles,name'
        ]); 
          }catch(\Exception $e){
            return['status'=>1000,'msg'=>'验证不通过'];
        }
        Role::create($request->only('name'));
        return ['status'=>0,'msg'=>'添加成功'];



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //修改显示
        $model=Role::find($id);


        return view('admin.role.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //修改处理\
         try{
              $this->validate($request,[
            'name'=>'required|unique:roles,name,'.$id.',id'
        ]); 
          }catch(\Exception $e){
            return['status'=>1000,'msg'=>'验证不通过'];
        }
        Role::where('id',$id)->update($request->only(['name']));

        return['status'=>0,'msg'=>'修改成功'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        Role::where('id',$id)->delete();
        return ['status'=>0,'msg'=>'删除成功'];
    }
    public function node(Role $role){
        // dd($role->nodes()->pluck('name','id')->toArray());
        $nodeall=(new Node())->getallList();
        //读取当前角色所拥有权限
        $nodes=$role->nodes()->pluck('id')->toArray();
        return view('admin.role.node',compact('role','nodeall','nodes'));
    }
    public function nodesave(Request $request,Role $role){
        $role->nodes()->sync($request->get('node'));
        return redirect(route('admin.role.index'));
    }
}
