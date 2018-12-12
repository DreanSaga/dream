<?php
/**
 * Created by PhpStorm.
 * User: 饶东
 * Date: 2018/12/7
 * Time: 11:54
 */

namespace App\Http\Controllers\Help;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Help;
use Illuminate\View\View;

class HelpController extends Controller{
    //显示
    public function Help_show(){
        $data=Help::list_show("back_help");//查询分类渲染下拉列表
        return View('Help/helpShow',['data'=>$data]);
    }
    //新增
     public function Help_Add(){
         if(request()->isMethod('get')){
             $data=Help::list_show("back_help");//查询分类渲染下拉列表
             return View("Help/helpAdd",['data'=>$data]);
         }else{
             $data=request()->all();
             $array=array(
                 'help_name'=>$data['help_name'],
                 'help_pid'=>$data['help_pid'],
                 'help_time'=>date("Y-m-d H:i:s"),
                 'help_content'=>$data['help_content'],
             );
             $info=Help::insert("back_help",$array);
             if($info){
                 return redirect('Help_show');
             }else{
                 echo "失败";
             }
         }
     }
    //删除
    public  function Help_Del($id){
        $input=request()->all();
        $data=Help::delete("back_help",$id);
        if($data){
            return redirect('Help_show');
        }else{
            echo "失败";
        }
    }
    //批量删除
    public function Help_delall(){
        $array=request()->only("id");
        $id=rtrim($array['id'],',');
        $data=Help::del("back_help",$id);
        if($data){
            return 1;
        }else{
            return 2;
        }
    }
    //修改渲染
    public  function Help_Edit($id){
        $data = Help::update("back_help", $id);
        $info = Help::list_show("back_help");//查询分类渲染下拉列表
        return View("Help/edit", ['data' => $data, 'info' => $info]);
    }
    //修改数据
    public function Help_Update(){
            $data=request()->all();//获取name值
            $array=array(
            'help_name'=>$data['help_name'],
            'help_pid'=>$data['help_pid'],
            'help_time'=>date("Y-m-d H:i:s"),
            'help_content'=>$data['help_content'],
        );
            //修改
            $data=Help::Edit("back_help",$data['id'],$array);
            if($data){
                return redirect('Help_show');
            }else{
                echo "失败";
            }
    }
    //搜索
    public function Help_search(){
        $input=request()->all();
        $name=$input['cate_name'];
        $sql="select * from back_help where help_name like '%".$input['cate_name']."%' or id like '%".$input['cate_name']."%'";
        $data=DB::select($sql);
        if($data){
            return view('Help/help_Search',['info'=>$data]);
        }else{
            echo "不存在";
        }
    }
}