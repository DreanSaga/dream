<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Image{
	public static function getImage(){
		$result['dataList']=DB::table('back_imagelist')->orderBy('create_time','desc')->paginate(3);
		$result['count']=count($result['dataList']);
		return $result;
	}
	public static function image_add($info,$img){
		$path=self::upload($img);//图片路径
		$str=substr($info['link'],0,7);
		if($str=='http://'){
			$link=$info['link'];
		}else{
			$link='http://'.$info['link'];
		}
		$array=array(
			'img_name'=>$info['image_name'],
			'img_link'=>$link,
			'img_sort'=>$info['sort'],
			'img_path'=>$path,
			'create_time'=>date('y-m-d H:i:s')
		);
		$res=DB::table('back_imagelist')->insert($array);
		if($res){
			$result['status']=200;
			$result['message']='添加图片成功';
		}else{
			$result['status']=300;
			$result['message']='添加图片失败';
		}
		return $result;
	}
	//图片上传
	public static function upload($img){
		$ext = $img->getClientOriginalExtension();
		$fileName = date('YmdHis').rand(111111,999999).'.'.$ext;
		$path = $img->move("./uploads",$fileName);//执行--图片会进入到upload文件夹
		$paths = '/uploads/'.$fileName;
		return $paths;
	}
	//图片删除
	public static function image_del($info){
		$res=DB::table('back_imagelist')->where('id',$info['id'])->delete();
		if($res){
			$result['status']=200;
			$result['message']='图片删除成功';
		}else{
			$result['status']=300;
			$result['message']='图片删除失败';
		}
		return $result;
	}
	//图片修改--查询
	public static function edit_show($info){
		$result=DB::table('back_imagelist')->where('id',$info['id'])->first();
		return $result;
	}
	//图片修改
	public static function image_edit($info,$img){
		if(empty($img)){
			$path=$info['old'];
		}else{
			$path=self::upload($img);//图片路径
		}
		$str=substr($info['link'],0,7);
		if($str=='http://'){
			$link=$info['link'];
		}else{
			$link='http://'.$info['link'];
		}
		$array=array(
			'img_name'=>$info['image_name'],
			'img_link'=>$link,
			'img_sort'=>$info['sort'],
			'img_path'=>$path,
		);
		$res=DB::table('back_imagelist')->where('id',$info['id'])->update($array);
		if($res){
			$result['status']=200;
			$result['message']='修改图片成功';
		}else{
			$result['status']=300;
			$result['message']='修改图片失败';
		}
		return $result;
	}
}