<?php
namespace app\index\controller;

use think\Controller;

class Article extends Controller
{

    //与后台基类初始化函数有冲突
    /*public function index()
    {
        $cateres = db('cate')->order('id')->select();

        $this->assign('cateres',$cateres);
       return $this->fetch('article');
    }*/
    public function index(){

        $cateres = db('cate')->order('id')->select();
        $this->assign('cateres',$cateres);
        $arid = input('arid');
        $articles = db('article')->find($arid);
        db('article')->where('id','=',$arid)->setInc('click');
        $cates = db('cate')->find($articles['cateid']);
        $this->assign(array(
            'articles'=>$articles,
            'cates'=>$cates
        ));
        return $this->fetch('article');
    }

}
