<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddArtRequest;
class ArticleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->header('X-Requested-With')=='XMLHttpRequest'){
            //开启位置
            $start=$request->get('start',0);
            //开始日期
            $datemin=$request->get('datemin');
            //结束时间
            $datemax=$request->get('datemax');
             //i
             $title=$request->get('title');
             $query=Article::where('id','>',0);
             if(!empty($datemin)&&!empty(datemax)){
                $datemin=date('Y-m-d H:i:s',strtotime($datemin.'00:00:00'));
                $datemax=date('Y-m-d H:i:s',strtotime($datemax.'23:59:59'));
                $query->whereBetween('created_at',[$datemin,$datemax]);
             }
             if(!empty($title)){
                $query->where('title','like','%{title}%');
             }
            $length=min(100,$request->get('length',10));
            $data=$query->offset($start)->limit($length)->get();
            $k=Article::count();
           
            $result=[
                'draw'=>$request->get('draw'),
                'recordsFiltered'=>$k,
                'data'=>$data
            ];
            return json_encode($result);
        }
        $data=Article::all()->toArray();
        $k=Article::count();
        return view('admin.article.index',compact('data','k'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.article.create');
    }


//文件上传
    public function upfile(Request $request){
         $pic=config('up.pic');
        if($request->hasFile('file')){
            //配置的节点
            $ret=$request->file('file')->store('','article');
            $pic='/uploads/article/'.$ret;

        }
        return['static'=>0,'url'=>$pic];
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddArtRequest $request)
    {
        //
        $post=$request->except('_token','file');
        Article::create($post);
        return redirect(route('admin.article.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
        return view('admin.article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
            $putData=$request->except(['action','created_at','updated_at','deleted_at','id']);
            $article->update($putData);
            return['status'=>0,'url'=>route('admin.article.index')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return ['msg'=>'删除成功'];
    }
}
