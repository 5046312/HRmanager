<?php
namespace app\index\model;
use think\Model;

class User extends Model
{
    /**
     * 根据Uname查找用户
     * return array
     */
    public function findOneByUname($uname){
        $res = $this->where('uname', $uname)->find();
        if($res){
            return $res->toArray();
        }else{
            return false;
        }
    }
}