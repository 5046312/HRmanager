<?php
namespace app\admin\controller;
use app\admin\model\Category as Column_model;
class Category extends Base
{
    /**
     * 栏目
     */
    public function column(){
        //一级分类
        $type = new Column_model();
        $res = $type->select();
        $this->assign('res', json_encode($res));
        return $this->fetch('column');
    }
    public function addColumn($pid = 0){
        //一级分类
        $type = new Column_model();
        $res = $type->where('pid', '0')->select();
        $this->assign('res', $res);
        $this->assign('pid', $pid);
        return $this->fetch('addColumn');
    }
    public function addColumnAct(){
        $column = new Column_model();
        $column->data([
            'cname' => input('post.cname'),
            'status' => input('post.status'),
            'zindex' => input('post.zindex'),
            'pid' => input('post.pid')
        ]);
        $column->save();
        $this->success('添加成功');
    }
    //die////
    public function editColumn($pid = 0){

    }
    public function editColumnAct(){

    }
}