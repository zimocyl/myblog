<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/22
 * Time: 13:43
 */

namespace app\admin\validate;
use think\Validate;



class Admin extends Validate
{
    protected $rule = [
                'username'  =>  'require|max:25',
                'password' =>  'require',
    ];
    protected $message = [
                'username'  =>  '管理员名必填且不能超过25位',
                'password'  =>  '密码必填',
        //也可以分开写
        //'username.require'    =>  '管理员名称必须填写',
        //'username.max         =>  '长度不能超过25位'
        //'password.require'    =>  '管理员密码必填'
    ];
    protected $scene    =   [
        'add'   =>  ['username'],
    ];

}