<?php
namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\FangOwner;
use Illuminate\Http\Request;
use App\Exports\FangOwnerExport;
class FangOwnerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exports(){

         return Excel::download(new FangOwnerExport, 'FangOwner.xlsx');
    }


    public function index()
    {
        //
        $data=FangOwner::get();
        $k=FangOwner::count();
        return view('admin.fangowner.index',compact('data','k'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fangowner.create');
    }


   public function upfile(Request $request){
        if($request->hasFile('file')){
            //配置的节点
            $ret=$request->file('file')->store('','fangOwner');
            $pic='/uploads/fangOwner/'.$ret;

        }
        return['static'=>0,'url'=>$pic];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
        ],['phone.required'=>'手机号字段必填']);
        $postdate=$request->except(['_token','file']);
        $postdate['pic']=trim($postdate['pic'],'#');
        //入库
        FangOwner::create($postdate);
        return redirect(route('admin.fangOwner.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function show(FangOwner $fangOwner)
    {
        //
        $piclist=$fangOwner->pic;
        if(!empty($piclist)){
           $pic=explode('#',$piclist);
        $html="";
        //遍历
        array_map(function($item){
           echo "<div style='margin-top:20px'><img src='$item' width='100' height='100'></div>";
        },$pic); 
        }
        
        return '';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(FangOwner $fangOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FangOwner $fangOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FangOwner  $fangOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(FangOwner $fangOwner)
    {
        //
    }
    public function delfile(Request $request){
      $filepath=$request->get('file');
       $path=public_path().$filepath;
       // 删除指定文件
       unlink($path);
       return['status'=>0,'msg'=>'删除成功'];
    }
}
