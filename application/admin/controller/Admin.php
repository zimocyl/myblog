<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/21
 * Time: 13:59
 */

namespace app\admin\controller;

use app\admin\model\Admin as AdminModel;
use think\Loader;

class Admin extends Base
{

    public function lst(){
        $list = AdminModel::paginate(5);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }
    public function add(){
        if (request()->isPost()){
            //接受传过来的数据

            $data=['username'=>input('username'),
                    'password'=>input('password') ? md5(input('password')):'',
                ];
            $validate = Loader::validate('Admin');
            if (!$validate->scene('add')->check($data)){

                return  $this->error($validate->getError(),'add');

            }


            if (db('admin')->insert($data)){
                return $this->success('添加成功','lst');
            }else{
                return $this->error('添加管理员失败');
            }
            return;
        }
        return  $this->fetch();
    }
    public function del(){
        $id = input('id');
        if ($id!=1){
            if (db('admin')->where('id',$id)->delete()){
                return $this->success('删除管理员成功','lst');
            }else
            {
                return $this->error('删除管理员失败','lst');
            }
        }else{
            return  $this->error('超级管理员不能删除','lst');
        }
    }
    public function edit(){
        if (request()->isPost()){
            $data = [
                //隐藏域发过来的id
                'id'=>input('post.id'),
                'password'=>md5(input('post.password')),
                'username'=>input('post.username'),
            ];

            if ($data['id']!=1)
            {
                $result = db('admin')->update($data);
            }else{
                return  $this->error('超级管理员不能修改','lst');
            }
            if ($result){
                return $this->success('修改管理员成功','lst');
            }else
            {
                return $this->error('修改管理员失败','lst');
            }
        }

        $id = input('id');
        $res = db('admin')->where('id',$id)->find();
        $this->assign('res',$res);

        return $this->fetch();
    }
    public function logout(){
        session(null);
        $this->success('退出成功','Login/index');
    }
}