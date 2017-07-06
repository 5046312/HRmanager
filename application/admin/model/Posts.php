<?php

namespace app\admin\model;
use think\Model;

class Posts extends Model
{
    public function category(){
        //Category表的id是外键
        //主键:当前表的字段
        return $this->hasOne('Category', 'id', 'post_category');
    }

    public function tags(){

    }
}