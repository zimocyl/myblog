<?php
namespace app\index\controller;
use app\index\controller\Base;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $cateres = db('cate')->order('id')->select();

        $this->assign('cateres',$cateres);
       return $this->fetch();
    }

}
