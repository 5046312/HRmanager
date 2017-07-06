<?php
namespace app\admin\controller;
use think\Session;
class Index extends Base
{
    public function logout(){
        session::destroy();
        $this->redirect('public/login/index');
    }
    public function index(){
        return $this->fetch('index/index');
    }

    public function welcome(){
        $data['ip'] = session::get('public')['ip'];
        $data['last_login'] = session::get('public')['last_login'];
        return $this->fetch('welcome', $data);
    }

}