<?php
namespace app\index\controller;
use app\index\model\Company as Company_Model;
use think\Session;

class Center extends BaseCompany
{
    /**
     * 个人中心首页
     * @return \think\response\View
     */
    public function index(){
        // 查询当前默认公司,存Session
        if(!Session::has('currentCompany')){
            $Company_Model = new Company_Model();
            $condition['company_id'] = Session::get('User.current_company');
            $currentCompany = $Company_Model->findCompany($condition);
            Session::set('currentCompany', $currentCompany->toArray());
        }
        echo "current Company： ".Session::get('currentCompany.company_name');
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
//    	dump($excel);
    	dump(input('file.huamingce'));
    }


}