<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/22
 * Time: 13:43
 */

namespace app\admin\validate;
use think\Validate;



class Cate extends Validate
{
    protected $rule = [
                'catename'  =>  'require|max:4|unique',

    ];
    protected $message = [
                'catename'  =>  '栏目名必填且不能超过4位',



        //也可以分开写
        //'username.require'    =>  '管理员名称必须填写',
        //'username.max         =>  '长度不能超过25位'
        //'password.require'    =>  '管理员密码必填'
    ];
    protected $scene    =   [
        'add'   =>  ['catename'=>'require'],
        'edit'   =>  ['catename'=>'require'],

    ];

}