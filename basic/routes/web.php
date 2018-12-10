<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::any('login',"Admin\AdminController@login");//登陆
//用户登录状态下可以访问的页面
Route::group(['middleware' => 'check.login'], function(){
	Route::any('exit',"Admin\AdminController@login_out");//退出
	Route::any('index',"Admin\AdminController@index");//跳转首页
	Route::any('welcome',"Admin\AdminController@welcome");//首页桌面
	/**后台管理员系列**/
	Route::any('adminList',"Admin\AdminController@adminList");//管理员列表
	Route::any('adminAdd',"Admin\AdminController@addAdmin");//管理员添加
	Route::any('adminDel',"Admin\AdminController@delAdmin");//管理员删除
	Route::any('adminEdit',"Admin\AdminController@adminEdit");//管理员修改
});
//导航栏管理
Route::group(['prefix'=>'nav'], function(){
    Route::get('index',"Admin\NavController@index");//列表展示
    Route::any('insert',"Admin\NavController@insert");//添加导航名称
    Route::any('delete{id?}',"Admin\NavController@delete");//删除导航名称
    Route::get('edit{id?}',"Admin\NavController@edit");//跳转修改页面
    Route::any('doEdit',"Admin\NavController@doEdit");//执行修改
    Route::any('checkdel',"Admin\NavController@checkdel");//执行批量删除
});

Route::group(['prefix'=>'article'], function(){
    Route::get('type',"Admin\ArticleController@type");//分类展示
    Route::any('insert',"Admin\ArticleController@insert");//分类添加
    Route::any('delete{id?}',"Admin\ArticleController@delete");//分类删除

    Route::get('index',"Admin\ArticleController@index");
    Route::any('store',"Admin\ArticleController@store");
    Route::any('del{id?}',"Admin\ArticleController@del");

});





