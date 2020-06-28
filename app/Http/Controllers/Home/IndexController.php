<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection.php;
use QL\QueryList;
class IndexController extends Controller
{
    //
    public function index(){
   $data = QueryList::get('http://cms.querylist.cc/bizhi/453.html')->find('img')->attrs('src')->toArray();
       //打印结果
       print_r($data->all());

    }
}
