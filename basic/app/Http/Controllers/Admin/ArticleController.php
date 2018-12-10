<?php

namespace App\Http\Controllers\Admin;

use App\Model\articleModel;
use App\Model\articletype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    //分类列表
    public function type(){
        $assign['type']=articletype::get();
        return view("article.type",$assign);
    }

    //执行添加
    public function insert(Request $request){
        if(Request()->isMethod("post")){
            $model = $request->all();

            unset($model['_token']);

            $dada = articletype::insert($model);
            if($dada){
                return redirect("article/type");
            }
        }
    }

    //执行删除
    public function delete($id){ //删除
        articletype::where('id',$id)->delete();
        return redirect('article/type');
    }

    //文章列表
    public function index(){
        $assign['pe']=articletype::get();
        $assign['list']=articleModel::get();
        return view("article.index",$assign);
    }

    //执行添加
    public function store(Request $request){
        if(Request()->isMethod("post")){
            $model = $request->all();

            unset($model['_token']);

            $dada = articleModel::insert($model);
            if($dada){
                return redirect("article/index");
            }
        }else{
            $assign['art']=articletype::get();
            return view("article.add",$assign);
        }
    }

    public function del($id){ //删除
        articleModel::where('id',$id)->delete();
        return redirect('article/index');
    }
}
