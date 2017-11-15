<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

    /*//全局变量规则校验，对所有规则都有效
    Route::pattern([
        'id'    =>  '\d+',
        'name'  =>  '\w+'
    ]);
//局部变量规则，只对当前路由有效
Route::rule('hello/:id','admin/Index/index','GET|POST',['https'=>false],['id'=>'\d+']);
Route::rule('banner/:name','index/Index/index','GET');*/

    //简洁定义路由
    /*Route::get('add','admin/Index/add');
    Route::post('save','admin/Index/save');
    Route::any('delete/:id','admin/Index/delete');*/
    //路由分组
    //参数1：路由名字，参数2：回调函数
    /*Route::group('ask',function (){
        Route::get('/id','admin/Ask/page');    //相当于ask/2
        Route::post('/question','admin/Ask/question');    //相当于ask/question
        Route::any('/answer/:id','admin/Ask/answer');    //
    });*/
    //接口路由分组
    Route::group('api/:version/goods',function (){
            Route::post('/:id/:name','api/:version.Goods/index');
            Route::any('/test','api/:version.Goods/test');
            Route::any('/input','api/:version.Goods/input');

    });
    Route::get('hello/:name/:id','index/Index/myvalidate');

