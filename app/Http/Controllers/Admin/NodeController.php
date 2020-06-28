<?php

namespace App\Http\Controllers\Admin;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=new Node;
        $data=$data->getalllist();
        $k=Node::count();
        return view('admin.node.index',compact('data','k'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有的数据
        $data=Node::where('pid',0)->get();

        return view('admin.node.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        if(isset($request->route_name)){
           try{
             $this->validate($request,[
            'name'=>'required|unique:nodes,name',
            'route_name'=>'unique:nodes,route_name',
        ]); 
          }catch(\Exception $e){
            return['status'=>1000,'msg'=>'验证不通过'];
        }

        }    
        Node::create($request->except('_token'));
        return ['status'=>0,'msg'=>'添加权限成功'];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function show(Node $node)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function edit(Node $node)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Node $node)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Node  $node
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //

        $k=Node::where('id',$id)->delete();
        
         return ['status'=>0,'msg'=>'删除成功'];   
   

    }
}
