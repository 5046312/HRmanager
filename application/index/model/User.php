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

    /**
     * 设置当前默认所在公司
     */
    public function setCurrentCompany($uid, $company_id){
        return $this->where('user_id', $uid)->update(['current_company'=>$company_id]);
    }
}