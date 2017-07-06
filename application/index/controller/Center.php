<?php
namespace app\index\controller;
class Center extends Base
{
    /**
     * 个人中心首页
     * @return \think\response\View
     */
    public function index(){
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