<?php
namespace App\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Session;

class Admin{
	//登陆
	public static function admin_login($info){
		$user = DB::table('back_admin')->where('back_user',$info['username'])->first();
		if(empty($user)){
			$result['status']=404;
			$result['message']='该用户不存在';
			return $result;
		}else{
			if($user->back_user != $info['username'] & $user->back_password == md5($info['password'])){
				$result['status']=403;
				$result['message']='用户名输入错误';
				return $result;
			}elseif($user->back_user==$info['username'] & $user->back_password!=md5($info['password'])){
				$result['status']=402;
				$result['message']='密码输入错误';
				return $result;
			}else{
				//登录成功修改最后登录时间
				DB::table('back_admin')->where('back_user',$info['username'])->update(['back_login_status'=>1,'back_last_login'=>date('Y-m-d H:i:s')]);
				//登陆成功是，将登陆用户的id，姓名，以及身份存入session
				$userinfo = array('id'=>$user->id,'username'=>$user->back_user,'is_super'=>$user->is_super);
				Session::put('userinfo',$userinfo);
				$result['status']=200;
				$result['message']='登陆成功';
				return $result;
			}
		}
	}
	//退出
	public static function loginout(){
		//将登录状态变为0---未登录
		$res = DB::table('back_admin')
			->where('id',Session::get('userinfo')['id'])
			->update(['back_login_status'=>0]);
		if($res){
			Session::flush();//清除所有session信息
			$result['status']=200;
			$result['message']='退出成功';
			return $result;
		}
	}
	//管理员列表
	public static function admin_list(){
		$result['dataList'] = DB::table('back_admin')->paginate(3);
		$result['count']=count(DB::table('back_admin')->get());//总条数
		return $result;
	}
	//添加管理员
	public static function admin_add($info){
		if(empty($info['username'])){
			$result['status']=202;
			$result['message']="请输入管理员名称";
		}else{
			if(empty($info['password'])){
				$result['status']=203;
				$result['message']="请输入管理员密码";
			}else{
				if($info['password']!=$info['repass']){
					$result['status']=204;
					$result['message']="两次密码不一致";
				}else{
					$date = DB::table('back_admin')->where('back_user',$info['username'])->first();
					if(empty($date)){
						$user = array(
							'back_user'=>$info['username'],
							'back_password'=>md5($info['password']),
							'back_insert_time'=>date('Y-m-d H:i:s',time())
						);
						$res = DB::table('back_admin')->insert($user);
						if($res){
							$result['status']=200;
							$result['message']="添加成功";
						}
					}else{
						$result['status']=206;
						$result['message']="用户已存在";
					}
				}
			}
		}
		return $result;
	}
	//管理员删除
	public static function admin_delete($id){
		$res=DB::table('back_admin')->where('id',$id)->delete();
		if($res){
			$result['status']=200;
			$result['message']='删除成功';
			return $result;
		}else{
			$result['status']=300;
			$result['message']='删除失败';
			return $result;
		}
	}
	//修改管理员---查询
	public static function getAdmin($id){
		$result=DB::table('back_admin')->where('id',$id)->first();
		return $result;
	}
	//修改管理员信息
	public static function admin_edit($info){
		if(empty($info['username'])){
			$result['status']=202;
			$result['message']="请输入管理员名称";
		}else{
			if(empty($info['password'])){
				$result['status']=203;
				$result['message']="请输入管理员密码";
			}else{
				if($info['password']!=$info['repass']){
					$result['status']=204;
					$result['message']="两次密码不一致";
				}else{
					$user = array(
						'back_user'=>$info['username'],
						'back_password'=>md5($info['password']),
					);
					$res = DB::table('back_admin')->where('id',$info['id'])->update($user);
					if($res){
						$result['status']=200;
						$result['message']="修改成功";
					}else{
						$result['status']=206;
						$result['message']="用户已存在";
					}
				}
			}
		}
		return $result;
	}
}