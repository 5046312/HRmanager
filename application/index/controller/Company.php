<?php
namespace app\index\controller;
use think\Session;
use app\index\model\Company as Company_Model;
use app\index\controller\Base;
class Company extends Base
{
    /**
     * 选择当前操作公司页面
     */
    public function index(){
        $companyModel = new Company_Model();
        $condition['uid'] = Session::get('User')['user_id'];
        $companyList = $companyModel->selectCompany($condition);
        // 从未添加过公司，跳转到添加公司页
        if(empty($companyList)){
            return $this->redirect('index/company/addCompany');
        }
        $this->assign('companyList', $companyList);
        return view();
    }

    /**
     * 处理选择公司
     */
    public function selectCompanyAct(){
        dump(input('post.'));
    }

    /**
     * 显示添加公司
     */
    public function addCompany(){
        return view();
    }

    /**
     * 处理添加公司
     */
    public function addCompanyAct(){
        $newData =[
            'uid' => Session::get("User")['user_id'],
            'company_name' => input('post.company_name'),
            'address' => input('post.address'),
            'hire_date' => strtotime(input('post.hire_date')),
            'create_time' => time()
        ];
        $Company_Model = new Company_Model();
        $Company_Model->addCompany($newData);
        return $this->redirect('index/company/index');
    }

}