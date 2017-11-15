<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/21
 * Time: 13:59
 */

namespace app\admin\controller;


use app\admin\model\Cate as CateModel;
use think\Loader;

class Cate extends Base
{
    public function lst(){
        $list = CateModel::paginate(5);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }
    public function add(){
        if (request()->isPost()){
            //接受传过来的数据

            $data=['catename'=>input('catename'),

                ];
            $validate = Loader::validate('cate');
            if (!$validate->scene('add')->check($data)){

                return  $this->error($validate->getError(),'add');

            }


            if (db('cate')->insert($data)){
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
            if (db('cate')->where('id',$id)->delete()){
                return $this->success('删除栏目成功','lst');
            }else
            {
                return $this->error('删除栏目失败','lst');
            }
        }else{
            return  $this->error('顶级栏目不能删除','lst');
        }
    }
    public function edit(){
        if (request()->isPost()){
            $data = [
                //隐藏域发过来的id
                'id'=>input('post.id'),

                'catename'=>input('post.catename'),
            ];

            $validate = Loader::validate('cate');
            if (!$validate->scene('edit')->check($data)){

                return  $this->error($validate->getError(),'edit');

            }
            if ($data['id']!=1)
            {
                $result = db('cate')->update($data);
            }else{
                return  $this->error('顶级栏目不能修改','lst');
            }
            if ($result){
                return $this->success('修改栏目成功','lst');
            }else
            {
                return $this->error('修改栏目失败','lst');
            }
        }

        $id = input('id');
        $res = db('cate')->where('id',$id)->find();

        $this->assign('res',$res);

        return $this->fetch();
    }
}