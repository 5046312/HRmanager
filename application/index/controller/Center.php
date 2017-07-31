<?php
namespace app\index\controller;
use app\index\controller\BaseCompany;
use think\Session;

class Center extends BaseCompany
{
    /**
     * 个人中心首页
     * @return \think\response\View
     */
    public function index(){
        echo "current Company ".Session::get('Company');
        return view();
    }

    /**
     * 花名册界面
     */
    public function huamingce(){
        return view();
    }

    /**
	 * 导入花名册
     */
    public function importHuamingce(){
    	$excel = new \PHPExcel();
    	dump($excel);
    	dump(input('file.huamingce'));
    }


}