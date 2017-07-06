<?php
namespace app\index\controller;
use app\index\model\User;
use think\Controller;
use think\Session;
use app\index\model\User as User_model;
class Index extends Controller
{
    /**
     * 主页
     */
    public function index()
    {
        return view();
    }

    /**
     * 登陆显示页
     */
    public function login(){
        return view();
    }

    /**
     * 登陆处理页
     */
    public function loginAct(){
        $data = [
            'uname'=> input('post.uname'),
            'upass'=> input('post.upass')
        ];
        $validate = validate('User');
        if(!$validate->check($data)){
            // 登陆验证失败
            $this->error($validate->getError());
        }else{
            // 登陆验证成功，进行账号密码判断
            $user = new User_model();
            $info = $user->findOneByUname($data['uname']);
            if(!$info || empty($info)){
                $this->error($data['uname'].'，账号不存');
            }else{
                // 账号存在，判断密码
                if($data['upass'] != $info['upass']){
                    // 密码错误,session +1
                    if(Session::get('LoginError')){
                        Session::set('LoginError', Session::get('LoginError')+1);
                    }else{
                        Session::set('LoginError', 1);
                    }
                    $this->error('密码错误，请重试');
                }else{
                    // 密码正确，session，跳个人主页
                    Session::set('User', $info);
                    return $this->redirect('index/center/index');
                }
            }
        }
    }

    /**
     * 退出登陆
     */
    public function logOut(){
        Session::clear();
        return $this->redirect('index');
    }
}
