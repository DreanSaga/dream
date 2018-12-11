<?php

namespace App\Http\Controllers\Admin;

use App\Model\navModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    //展示
    public function index(){
        $assign['list'] = navModel::showType();
        return view("nav.index",$assign);
    }
    //执行添加
    public function insert(Request $request){
        if(Request()->isMethod("post")){
            $model = $request->all();

            unset($model['_token']);

            $dada = navModel::insert($model);
            if($dada){
                return redirect("nav/index");
            }
        }else{
            return view("nav.add");
        }
    }
    //执行删除
    public function delete($id){ //删除
        navModel::where('id',$id)->delete();
        return redirect('nav/index');
    }

    //跳转修改页面
    public function edit($id)
    {
        $assign["list"] = navModel::where('id', $id)->first();
        return view('nav.edit', $assign);
    }
    //执行修改
    public function doEdit(Request $request){
        $params = $request->all();
        if(isset($params['_token'])){
            unset($params['_token']);
        }
//        print_r($params);die;
        $nav = navModel::find($params['id']);

//            print_r($nav);die;
        $data = DB::table('back_nav')->where('id',$nav['id'])->update($params);
        if($data){
            return redirect("nav/index");
        }
    }
    //批量删除
    public function checkdel(Request $request){
        $id=$request->post("id");
        if(isset($id['_token'])){
            unset($id['_token']);
        }
        $id=explode(",",$id);
        $object=new navModel();
        if($object->whereIn("id",$id)->delete()){
            return [
                "code"=>200,
                "data"=>"删除成功"
            ];
        }
    }


}
