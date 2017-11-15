<?php
namespace app\index\controller;


use think\Controller;

class Cate extends Controller
{
    public function index()
    {
        $cateres = db('cate')->order('id')->select();
        $this->assign('cateres',$cateres);


        $cateid=input('cateid');
        //查询当前栏目名称
        $cates=db('cate')->find($cateid);
        $this->assign('cates',$cates);
        //查询当前栏目下的文章
        $articleres=db('article')->where(array('cateid'=>$cateid))->paginate(2);
        $this->assign('articleres',$articleres);
        return $this->fetch('cate');
        /*$cateid = input('cateid');
        $articles=db('article')->where('cateid','=',$cateid)->paginate(3);
        $this->assign('articleres',$articles);
       return $this->fetch('cate');*/
    }

}
