<?php
namespace app\admin\controller;
use think\Controller;
use Hautelook\Phpass\PasswordHash;
use app\admin\model\Users as Users_model;
use think\Session;
use app\admin\model\Log as Log_model;
class Login extends Controller
{
    public function index()
    {
        return $this->fetch('login');
    }
    public function login()
    {
        if(!captcha_check(input('post.captcha'))){
            $this->writeLog(0, input('post.uname'));
            $this->error('验证码错误');
        };
        $user = new Users_model();
        $res = $user->where('uname', input('post.uname'))->find();
        if(!$res){
            $this->writeLog(3, input('post.uname'));
            $this->error('不存在');
        }
        $passwordHasher = new PasswordHash(8, true);
        if($passwordHasher->CheckPassword(input('post.upass'), $res->upass)){
            session::set('public', $res->getData());
            $this->writeLog(1, input('post.uname'));
            $res->ip = get_client_ip();
            $res->last_login = date('Y-m-d H:i:s');
            $res->save();
            $this->success('成功', url('admin/index/index'));
        }else{
            $this->writeLog(2, input('post.uname'));
            $this->error('密码错误');
        }
    }

    private function writeLog($type, $uname){
        $info = '';
        switch ($type){
            case 0:
                $info = '验证码错误';
                break;
            case 1:
                $info = '登陆成功';
                break;
            case 2:
                $info = '密码错误';
                break;
            case 3:
                $info = '账号不存在';
                break;
        }
        $log = new Log_model;
        $log->data([
            'type' => $info,
            'uname' => $uname,
            'ip' => get_client_ip(),
            'create_time' => date('Y-m-d H:i:s')
        ]);
        $log->save();
    }

    public function test(){
        $passwordHasher = new PasswordHash(8, true);
        $user = new Users_model();
        $user->data([
            'uname'=>'5046312',
            'upass'=>$passwordHasher->HashPassword('a5046312'),
            'create_time'=>date('Y-m-d H:i:s')
        ]);
        $user->save();
    }
}