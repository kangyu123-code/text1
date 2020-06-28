<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fang;
use App\Models\Cite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FangController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //获取城市
    public function city(Request $request){
    $data=Cite::where('pid',$request->get('id'))->get(['id','name']);
    return $data;

    }

    public function index()
    {
        //关联关系的调用
        $data=Fang::with(['owner'])->paginate($this->pagesize);
        return view('admin.fang.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //取关联表数据
        $data=(new Fang())->relation();

        return view('admin.fang.create',compact('data'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function show(Fang $fang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function edit(Fang $fang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fang $fang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fang $fang)
    {
        //
    }
}
