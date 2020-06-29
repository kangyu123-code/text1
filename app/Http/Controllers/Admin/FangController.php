<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fang;
use App\Models\Cite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FangRequest;
use GuzzleHttp\Client;
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

       

        $data=Fang::with(['owner','attr','atts'])->paginate($this->pagesize);
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
    public function store(FangRequest $request)
    {
        //
        $post=$request->except(['_token','file']);
        $model=Fang::create($post);
        //添加入库成功
        //发起http请求
           $client=new Client(['timeout'=>5]);
        $url=config('gaode.geocode');
        $url=sprintf($url,$model->fang_addr,$model->fang_province);
        $resp=$client->get($url);
        $body=(string)$resp->getBody();
        $arr=json_decode($body,true);
        if(count($arr['geocodes'])>0){
            $location=explode(',', $arr['geocodes'][0]['location']);
            $model->update([
                'longitude'=>$location[0],
                'latitude'=>$location[1]
            ]);
            dd($location);
        }
        
        // $cilent->get
        return redirect(route('admin.fang.index'));
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

     public function upfile(Request $request){
        if($request->hasFile('file')){
            //配置的节点
            $ret=$request->file('file')->store('','fang');
            $pic='/uploads/fang/'.$ret;

        }
        return['static'=>0,'url'=>$pic];
    }
     public function delfile(Request $request){
      $filepath=$request->get('file');
       $path=public_path().$filepath;
       // 删除指定文件
       unlink($path);
       return['status'=>0,'msg'=>'删除成功'];
    }
}
