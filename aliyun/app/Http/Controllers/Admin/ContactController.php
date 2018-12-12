<?php

namespace App\Http\Controllers\Admin;

use App\Model\contactModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(){
        $assign['list']=contactModel::get();
        return view("contact.index",$assign);
    }

    public function store(Request $request){
        if(Request()->isMethod("post")){
            $params = $request->all();

            if(isset($params['_token'])){
                unset($params['_token']);
            }
            $params['image'] = $this->uploadFile($params['image']);

            $re =DB::table("back_contact")->insert($params);

            if($re){
                return redirect("contact/index");
            }
        }else{
            return view("contact.add");
        }
    }
    //跳转修改页面
    public function edit($id){
        $assign['info'] = contactModel::where('id', $id)->first();
        return view('contact.edit',$assign);
    }

    //执行修改
    public function doEdit(Request $request){

        $params = $request->all();

        if(isset($params['_token'])){
            unset($params['_token']);
        }
        if($_FILES['image']['error']>0){

        }else{
            $params['image'] = $this->uploadFile($params['image']);
        }


        $contact = contactModel::find($params['id']);

        $data = DB::table('back_contact')->where('id',$contact['id'])->update($params);

        if($data){
            return redirect('contact/index');
        }
    }
    public function delete($id){ //删除
        contactModel::where('id',$id)->delete();
        return redirect('contact/index');
    }
    //批量删除
    public function checkdel(Request $request){
//        alert(11);die;
        $id=$request->get("id");
//        print_r($id);die;
        if(isset($id['_token'])){
            unset($id['_token']);
        }
//        print_r($id);die;
        $id=explode(",",$id);
        $object=new contactModel();
        if($object->whereIn("id",$id)->delete()){
            return [
                "code"=>200,
                "data"=>"删除成功"
            ];
        }
    }


}
