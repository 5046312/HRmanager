<?php
namespace app\index\model;
use think\Model;
class Company extends Model
{
    // 查 按添加时间排序
    public function selectCompany($condition=''){
        return $this->where($condition)->order('create_time desc')->select();
    }

    // 增
    public function addCompany($data){
        return $this->save($data);
    }

    // 按条件查询单个公司
    public function findCompany($condition = '*', $field = "*"){
        return $this->where($condition)->field($field)->find();
    }

}