<?php
/**
 * Created by PhpStorm.
 * User: cyl
 * Date: 2017/10/21
 * Time: 13:59
 */

namespace app\admin\controller;


use app\admin\model\Article as ArticleModel;
use think\Loader;

class Article extends Base
{
    public function lst(){
        $list = ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch('lst');
    }
    public function add(){
        if (request()->isPost()){
            //接受传过来的数据
            $data=[
                'title'=>input('title'),
                'author'=>input('author'),
                'desc'=>input('desc'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'content'=>input('content'),
                'cateid'=>input('cateid'),
                'time'=>time(),
            ];

            if(input('state')=='on'){
                $data['state']=1;
            }
            if ($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                $data['pic'] = '/uploads/'.$info->getSaveName();
                /*//制作缩略图
                $thumb = new \Thumb(ROOT_PATH . 'public' . DS . 'static/uploads');
                dump($thumb);
                die;

                $thumb -> thumb_path = ROOT_PATH . 'public' . DS . 'static/thumbs';
                $thumb_file = $thumb -> make_thumb();*/

            }
            $validate = Loader::validate('Article');
            if (!$validate->scene('add')->check($data)){

                return  $this->error($validate->getError(),'add');

            }


            if (db('Article')->insert($data)){
                return $this->success('添加成功','lst');
            }else{
                return $this->error('添加失败');
            }
            return;
        }
        $res = db('cate')->select();
        $this->assign('res',$res);
        return  $this->fetch();
    }
    public function del(){
        $id = input('id');
            $res = db('article')->where('id',$id)->find();

            if (!unlink($_SERVER['DOCUMENT_ROOT'].'/static'.$res['pic'])){
                return $this->error('删除文章失败','lst');
            }
            if (db('article')->where('id',$id)->delete()){
                return $this->success('删除文章成功','lst');
            }else
            {
                return $this->error('删除文章失败','lst');
            }
        }

    public function edit(){
        if (request()->isPost()){
            //接受传过来的数据
            $data=[
                'title'=>input('title'),
                'author'=>input('author'),
                'desc'=>input('desc'),
                'keywords'=>str_replace('，', ',', input('keywords')),
                'content'=>input('content'),
                'cateid'=>input('cateid'),
                'time'=>time(),
            ];

            if(input('state')=='on'){
                $data['state']=1;
            }
            if ($_FILES['pic']['tmp_name']){
                $id = input('id');
                $res = db('article')->where('id',$id)->find();
                if (!unlink($_SERVER['DOCUMENT_ROOT'].'/static'.$res['pic'])){
                    return $this->error('修改文章失败,原图不能删除','lst');
                }
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');


                $data['pic'] = '/uploads/'.$info->getSaveName();
            }
            $validate = Loader::validate('Article');
            if (!$validate->scene('edit')->check($data)){

                return  $this->error($validate->getError(),'add');

            }

            $id = input('id');
            if (db('Article')->where('id',$id)->update($data)){
                return $this->success('修改成功','lst');
            }else{
                return $this->error('修改失败');
            }
            return;
        }

        $id = input('id');
        $res = db('article')->where('id',$id)->find();
        $rescate = db('cate')->select();
        $this->assign('res',$res);
        $this->assign('rescate',$rescate);

        return $this->fetch();
    }
}