<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fangattr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FangAttrController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $model=new Fangattr();
        $data=$model->getList();
        $k=$model->count();
        return view('admin.fangattr.index',compact('data','k'));
    }
    public function upfile(Request $request){
        if($request->hasFile('file')){
            //配置的节点
            $ret=$request->file('file')->store('','fangattr');
            $pic='/uploads/fangattr/'.$ret;

        }
        return['static'=>0,'url'=>$pic];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=Fangattr::where('pid',0)->get();
        return view('admin.fangattr.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'名称必填',
        ]);
        $post=$request->except(['_token','file']);
        Fangattr::create($post);
        return redirect(route('admin.fangattr.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fangattr  $fangattr
     * @return \Illuminate\Http\Response
     */
    public function show(Fangattr $fangattr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fangattr  $fangattr
     * @return \Illuminate\Http\Response
     */
    public function edit(Fangattr $fangattr)
    {
        //
        $data=Fangattr::where('pid',0)->get();

        return view('admin.fangattr.edit',compact('data','fangattr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fangattr  $fangattr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fangattr $fangattr)
    {
        //
          $this->validate($request,[
            'name'=>'required',
            'field_name'=>'required'

        ],[
            'name.required'=>'名称必填',
            'field_name.required'=>'字段名必填',
        ]);
        $post=$request->except(['_token','file','_method']);
        $fangattr->update($post);
        return redirect(route('admin.fangattr.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fangattr  $fangattr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fangattr $fangattr)
    {
        //
        $fangattr->delete();
        return['status'=>0,'msg'=>'删除成功'];
    }
}
