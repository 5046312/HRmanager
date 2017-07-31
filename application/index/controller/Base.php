<?php
namespace app\index\controller;
use think\Controller;
use think\Session;

class Base extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!Session::get('User')){
            return $this->redirect('index/index/login');
        }
    }
}
