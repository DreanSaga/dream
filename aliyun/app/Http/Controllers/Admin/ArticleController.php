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
    public function type()
    {
        $assign['type'] = articletype::get();
        return view("article.type", $assign);
    }

    //执行添加
    public function insert(Request $request)
    {
        if (Request()->isMethod("post")) {
            $model = $request->all();

            unset($model['_token']);

            $dada = articletype::insert($model);
            if ($dada) {
                return redirect("article/type");
            }
        }
    }

    //执行删除
    public function delete($id)
    { //删除
        articletype::where('id', $id)->delete();
        return redirect('article/type');
    }

    //文章列表
    public function index()
    {
        $assign['pe'] = articletype::get();
        $assign['list'] = articleModel::get();
        return view("article.index", $assign);
    }

    //执行添加
    public function store(Request $request)
    {
        if (Request()->isMethod("post")) {
            $model = $request->all();

            unset($model['_token']);

            $dada = articleModel::insert($model);
            if ($dada) {
                return redirect("article/index");
            }
        } else {
            $assign['art'] = articletype::get();
            return view("article.add", $assign);
        }
    }

    public function del($id)
    { //删除
        articleModel::where('id', $id)->delete();
        return redirect('article/index');
    }

    //跳转修改页面
    public function edit($id)
    {
        $assign['s'] = articletype::get();
        $assign["list"] = articleModel::where('id', $id)->first();
        return view('article.edit', $assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();
        if (isset($params['_token'])) {
            unset($params['_token']);
        }
//        print_r($params);die;
        $article = articleModel::find($params['id']);

//            print_r($nav);die;
        $data = DB::table('back_new_list')->where('id', $article['id'])->update($params);
        if ($data) {
            return redirect("article/index");
        }
    }

    public function checkdel(Request $request){
        $id=$request->get("id");
        if(isset($id['_token'])){
            unset($id['_token']);
        }
        $id=explode(",",$id);
        $object=new articleModel();
        if($object->whereIn("id",$id)->delete()){
            return [
                "code"=>200,
                "data"=>"删除成功"
            ];
        }
    }

    //及点及改
    public function change(Request $request){
        $data=$request->all();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
//        return $data;die;
        $array['new_type']=$data['new_type'];
//        return $array;die;
        $info=articletype::where(array("id"=>$data['id']))->update($array);
        //return $info;die;
        if($info){
            $infos['status']=200;
            $infos['content']="获取数据成功";
        }
        return $infos;
    }


}
