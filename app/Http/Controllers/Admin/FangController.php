<?php

namespace App\Http\Controllers\Admin;

use App\Models\Fang;
use App\Models\Cite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FangRequest;
use GuzzleHttp\Client;
use Elasticsearch\ClientBuilder;
class FangController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //获取城市
    public function city(Request $request){
        $info=$request->get('id');
        $data=Cite::where('pid',$info)->get(['id','name']);
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
        }
        // es数据的添加
           $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
           $params = [
                'index' => 'fang',
                'type' => '_doc',
                'id' => $model->id,
                'body' => [
                'fang_name' => $model->fang_name,
                'fang_desn' => $model->fang_desn,
                 ],
        ];
        $client->index($params);
        return redirect(route('admin.fang.index'));
    }

    public function change(Request $request)
    { 
        $id=$request->get('id');
        $status=$request->get('status');
        //根据id查询对应的房源信号
        Fang::where('id',$id)->update(['fang_status'=>$status]);
        return ['status'=>0,'msg'=>'修改状态成功'];
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
        // 房源修改显示
         $data=(new Fang())->relation();
        //得到当前用户 所属省对应市
         $shi=Cite::where('pid',$fang->fang_province)->get();
         //当前市所对应的区
         $qu=Cite::where('pid',$fang->fang_city)->get();
         $data['shi']=$shi;
         $data['qu']=$qu;
         $data['fang']=$fang;
         return view('admin.fang.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fang  $fang
     * @return \Illuminate\Http\Response
     */
    public function update(FangRequest $request, Fang $fang)
    {
        //
        $putdata=$request->except(['_method','_token','file']);
        $fang->update($putdata);
        $client=new Client(['timeout'=>5]);
        $url=config('gaode.geocode');
        $url=sprintf($url,$fang->fang_addr,$fang->fang_province);
        $resp=$client->get($url);
        $body=(string)$resp->getBody();
        $arr=json_decode($body,true);
        if(count($arr['geocodes'])>0){
            $location=explode(',', $arr['geocodes'][0]['location']);
            $fang->update([
                'longitude'=>$location[0],
                'latitude'=>$location[1]
            ]);
        }
         $client = ClientBuilder::create()->setHosts(config('es.host'))->build();
           $params = [
                'index' => 'fang',
                'type' => '_doc',
                'id' => $fang->id,
                'body' => [
                'fang_name' => $fang->fang_name,
                'fang_desn' => $fang->fang_desn,
                 ],
        ];
        $client->index($params);
        return redirect(Route('admin.fang.index'));
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
    //生成房源信息索引
    public function esinit(){
        //得到对象
        $client = ClientBuilder::create()->setHosts(config('es.host'))->build();

// 创建索引
        $params = [
            // 生成索引的名称
            'index' => 'fang',
            'body' => [
                'settings' => [
                    //分区
                    'number_of_shards' => 5,
                    //副本树
                    'number_of_replicas' => 1
                ],
                'mappings' => [
                    '_doc' => [
                        '_source' => [
                            'enabled' => true
                        ],
                        'properties' => [
                            //字段
                            'fang_name' => [
                                //数据查询中的等于
                                'type' => 'keyword'
                            ],
                            'fang_desn' => [
                                //中文分词
                                'type' => 'text',
                                'analyzer' => 'ik_max_word',
                                'search_analyzer' => 'ik_max_word'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        //创建索引
        $response = $client->indices()->create($params);
        dd($response);
            }
        }
        