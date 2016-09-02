<?php

namespace App\Http\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{

    static public function getUserTotalNum(){
        return DB::table('user')->where('u_status',1)->count();
    }

    //获取用户数据
    static public function getUser($userId,$page,$limit){
        if(empty($userId)){
            $result = DB::table('user')->skip(($page-1)*$limit)->take($limit)->where('u_status',1)->get();
        }else{
            $result = DB::table('user')->where('u_id',$userId)->where('u_status',1)->skip(($page-1)*$limit)->take($limit)->get();
        }
        return $result;
    }

    //增加用户
    static public function addUser($userInfo){
        if(!is_array($userInfo)){
            return false;
        }
        $result = DB::table('user')->insert($userInfo);

        return $result;
    }

    //修改用户
    static public function modifyUser($userId,$userInfo){
        if(empty($userId) || !is_numeric($userId) || !is_array($userInfo)){
            return false;
        }

        $result = DB::table('user')->where('u_id', $userId)->update($userInfo);

        return $result;
    }

    //删除用户
    static public function delUser($uids){
        if(empty($uids)){
            return false;
        }
        $result = DB::table('user')->whereIn('u_id',$uids)->update(array('u_status'=>2));

        return $result;
    }

}
