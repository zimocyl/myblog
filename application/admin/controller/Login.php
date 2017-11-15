<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/21
 * Time: 13:59
 */

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;

class Login extends Controller
{
    public function index(){
        if (request()->isPost()){
            $admin = new Admin();
            $data = input('post.');

            if ($admin->login($data)==3){
                $this->success('登录成功','index/index');
            }elseif($admin->login($data)==4){
                $this->error('验证码错误');
            }else{
                $this->error('登录失败');
            }
        }
        return $this->fetch('login');
    }
}