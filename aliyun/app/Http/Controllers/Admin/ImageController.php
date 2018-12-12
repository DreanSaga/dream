<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Image;
class ImageController extends Controller{
	//图片列表
	public function imageList(){
		$result=Image::getImage();
		return view('Image/imageList',['result'=>$result]);
	}
	//添加图片
	public function imageAdd(){
		if(Request()->isMethod('get')){
			return view('Image/imageAdd');
		}elseif(Request()->isMethod('post')){
			$result=Image::image_add(Request()->only('image_name','link','sort'),Request()->file('images'));
			if($result['status']==200){
				return redirect('imageList')->with('msg',$result['message']);
			}else{
				return redirect('imageList')->with('msg',$result['message']);
			}
		}
	}
	//删除轮播图
	public function imageDel(){
		$result=Image::image_del(Request()->only('id'));
		if($result['status']==200){
			return redirect('imageList')->with('msg',$result['message']);
		}else{
			return redirect('imageList')->with('msg',$result['message']);
		}
	}
	//图片修改
	public function imageEdit(){
		if(Request()->isMethod('get')){
			$info=Image::edit_show(Request()->only('id'));
			return view('Image/imageEdit',['info'=>$info]);
		}elseif(Request()->isMethod('post')){
			$result=Image::image_edit(Request()->only('image_name','link','sort','old','id'),Request()->file('images'));
			if($result['status']==200){
				return redirect('imageList')->with('msg',$result['message']);
			}else{
				return redirect('imageList')->with('msg',$result['message']);
			}
		}
	}
}