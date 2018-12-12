<?php
/**
 * Created by PhpStorm.
 * User: 饶东
 * Date: 2018/12/7
 * Time: 11:54
 */

namespace App\Http\Controllers\Live;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Live;
use Illuminate\View\View;

class LiveController extends Controller{
    //直播分类显示
    public function liveList(){
        $data=Live::list_show("back_videoType");//查询分类渲染下拉列表
        return View('Live/cate',['data'=>$data]);
    }
    //直播分类新增
    public function liveAdd(){
        if(request()->isMethod('get')){
             $data=Live::list_show("back_videoType");//查询分类渲染下拉列表
             return View("Live/live-add",['data'=>$data]);
        }else{
            $file=request()->file('video_image');//获取图片
            $ext = $file->getClientOriginalExtension();//获取图片后缀名
            $filename=date("YmdHis").time().'.'.$ext;//拼接新图片名
            $path=$file->move("./uploads",$filename);//入库图片
            $data=request()->all();
            $array=array('video_image'=>$path,
                'video_name'=>$data['video_name'],
                'pid'=>$data['pid'],
                'create_time'=>date("Y-m-d H:i:s"),
                'video_link'=>$data['video_link'],
            );
            $info=Live::insert("back_videoType",$array);
            if($info){
             return redirect('liveList');
            }else{
                echo "失败";
            }
        }
    }
    //删除
    public  function liveDel($id){
        $input=request()->all();
        $data=Live::delete("back_videoType",$id);
        if($data){
            return redirect('liveList');
        }else{
            echo "失败";
        }
    }
    //修改渲染
    public  function liveEdit($id){
        $data = Live::update("back_videoType", $id);
        $info = Live::list_show("back_videoType");//查询分类渲染下拉列表
        return View("Live/edit", ['data' => $data, 'info' => $info]);
    }
    //修改数据
    public function liveUpdate(){
            $file=request()->file('file_image');//获取图片信息
            if(empty($file)){
                $input=request()->all();//获取name值
                $array=array('video_name'=>$input['video_name'],
                    'video_image'=>$input['video_image'],
                    'video_link'=>$input['video_link'],
                    'pid'=>$input['pid'],);
                //修改
                $data=Live::Edit("back_videoType",$input['id'],$array);
                if($data){
                    return redirect('liveList');
                }else{
                    echo "失败";
                }
            }else{
                $ext = $file->getClientOriginalExtension();//获取图片后缀名
                $filename=date("YmdHis").time().'.'.$ext;//拼接新图片名
                $path=$file->move("./uploads",$filename);//入库图片
                $input=request()->all();//获取name值
                $array=array('video_name'=>$input['video_name'],
                    'video_image'=>$path,
                    'video_link'=>$input['video_link'],
                    'pid'=>$input['pid'],);
                //修改
                $data=Live::Edit("back_videoType",$input['id'],$array);
                if($data){
                    return redirect('liveList');
                }else{
                    echo "失败";
                }
            }
        }
        //批量删除
    public function delAll(){
        $array=request()->only("id");
        $id=rtrim($array['id'],',');
        $data=Live::del("back_videoType",$id);
        if($data){
            return 1;
        }else{
            return 2;
        }
    }
    //搜索
    public function search(){
        $input=request()->all();
        $name=$input['cate_name'];
        $sql="select * from back_videoType where video_name like '%".$input['cate_name']."%' or id like '%".$input['cate_name']."%'";
        $data=DB::select($sql);
        if($data){
            return view('Live/showSearch',['info'=>$data]);
        }else{
            echo "不存在";
        }
    }
}