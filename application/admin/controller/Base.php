<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if(!session::has('public')){
           $this->redirect('admin/login/index');
        }
    }
}