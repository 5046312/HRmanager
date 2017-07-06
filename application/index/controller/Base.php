<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if (!Session::get('User')){
            return $this->redirect('index/index/login');
        }
    }
}