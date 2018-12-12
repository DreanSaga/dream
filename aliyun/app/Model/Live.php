<?php
/**
 * Created by PhpStorm.
 * User: 饶东
 * Date: 2018/12/7
 * Time: 11:55
 */

namespace App\Model;
use Illuminate\Support\Facades\DB;
use Session;

class Live{
    //新增
    public static function insert($table,$array){
     $data=DB::table($table)->insert($array);
     return $data;;
   }
   //无限极自调用
    public static function list_show($table){
        $arr=DB::table($table)->get();
        $info=self::list_level($arr,$pid=0,$level=0);
        return $info;
    }
    public static function list_level($arr, $pid, $level)
    {
        static $data = array();
        foreach ($arr as $k => $v) {
            if ($v->pid == $pid) {
                $v->level = $level;
                $data[] = $v;
                self::list_level($arr, $v->id, $level + 1);
            }
        }
        return $data;
    }
    //显示
    public static function show($table){
        $data=DB::table($table)->paginate(10);
        return $data;
    }
    //删除
    public static  function delete($table,$id){
        $data=DB::table($table)->where('id',$id)->delete();
        return $data;
    }
    //修改渲染
    public static function update($table,$id){
        $data=DB::table($table)->where('id',$id)->first();
        return  $data;
    }
    //修改内容
    public static function Edit($table,$id,$array){
        $data=DB::table($table)->where('id',$id)->update($array);
        return  $data;
    }
    //批量删除
    public static function del($table,$id){
        $sql="delete from $table where id in ($id)";
        $data=DB::delete($sql);
        return $data;
    }
}