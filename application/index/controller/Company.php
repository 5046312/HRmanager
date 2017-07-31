<?php
namespace app\index\controller;
use think\Session;
use app\index\model\Company as Company_Model;
class Company extends Base
{
    /**
     * 判断是否已经选择公司
     */
    private function isSelectedCompany(){
        if(!Session::has('Company')){
            // 空则跳转选择公司页面
            return $this->redirect('index/center/selectCompany');
        }
    }

    /**
     * 选择当前操作公司页面
     */
    public function selectCompany(){
        $companyModel = new Company_Model();
        $condition['uid'] = Session::get('User')['user_id'];
        $companyList = $companyModel->selectCompany($condition);
        // 从未添加过公司，跳转到添加公司页
        if(empty($companyList)){
            return $this->redirect('index/center/addCompany');
        }
        $this->assign('companyList', $companyList);
        return view();
    }

    /**
     * 处理选择公司
     */
    public function doSelectCompany(){

    }

    /**
     * 显示添加公司
     */
    public function addCompany(){
        view();
    }

    /**
     * 处理添加公司
     */
    public function addCompanyAct(){

    }

}