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

Route::group(['prefix'=>'nav'], function(){
    Route::get('index',"Admin\NavController@index");//列表展示
    Route::any('insert',"Admin\NavController@insert");
    Route::any('delete{id?}',"Admin\NavController@delete");
    Route::get('edit{id?}',"Admin\NavController@edit");
    Route::any('doEdit',"Admin\NavController@doEdit");
    Route::any('checkdel',"Admin\NavController@checkdel");


});


