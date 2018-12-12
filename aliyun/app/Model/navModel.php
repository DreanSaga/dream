<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class navModel extends Model
{
    protected $table = "back_nav";

    //写一个showType方法
    static public function showType(){
        $info = DB::table("back_nav")->get();
        $result = self::list_level($info,$pid=0,$level=0);
        return $result;
    }

    //提供一个无限极分类调取的方法
    static public function list_level($data,$pid,$level){

        static  $array = array();
        foreach ($data as $k =>$v){
            if($pid == $v->pid){
                $v->level = $level;
                $array[] = $v;
                self::list_level($data,$v->id,$level+1);
            }
        }
        return $array;
    }

}
