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

class BaseCompany extends Base
{
    /**
     * 未选择公司则跳转到公司选择页
     * BaseCompany constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        if(!Session::has('Company')){
            return $this->redirect('index/company/index');
        }
    }
}