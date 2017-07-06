<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    /**
     * 主页
     */
    public function index()
    {
        return view();
    }

    /**
     * 登陆显示页
     */
    public function login(){
        return view();
    }

    /**
     * 登陆处理页
     */
    public function loginAct(){
        $data = [
            'uname'=> input('post.uname'),
            'upass'=> input('post.upass')
        ];
        $validate = validate('User');
        if(!$validate->check($data)){
            dump($validate->getError());
        }
    }

}
