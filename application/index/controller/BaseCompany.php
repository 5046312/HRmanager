<?php
namespace app\index\controller;
use think\Session;
class BaseCompany extends Base
{
    /**
     * 未选择公司则跳转到公司选择页
     * BaseCompany constructor.
     * @param Request|null $request
     */
    public function __construct()
    {
        parent::__construct();
        if(!Session::has('User.current_company')){
            return $this->redirect('index/company/index');
        }
    }
}