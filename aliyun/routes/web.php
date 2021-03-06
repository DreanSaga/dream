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
    Route::any('adminSearch',"Admin\AdminController@adminSearch");//管理员搜索
    //RBAC---权限
    Route::any('ruleList',"Admin\PrivilegeController@ruleList");//权限列表
    Route::any('ruleAdd',"Admin\PrivilegeController@ruleAdd");//权限新增
    Route::any('ruleEdit',"Admin\PrivilegeController@ruleEdit");//权限修改
    Route::any('ruleDel',"Admin\PrivilegeController@ruleDel");//权限删除
    //RBAC---角色
    Route::any('roleList',"Admin\PrivilegeController@roleList");//角色列表
    Route::any('roleAdd',"Admin\PrivilegeController@roleAdd");//角色新增
    Route::any('setRule',"Admin\PrivilegeController@setRule");//角色设置权限
    Route::any('roleDel',"Admin\PrivilegeController@roleDel");//角色删除
    Route::any('roleEdit',"Admin\PrivilegeController@roleEdit");//角色修改
    /*直播分类管理*/
    Route::any('liveList',"Live\LiveController@liveList");//直播分类列表
    Route::any('liveAdd',"Live\LiveController@liveAdd");//直播分类添加
    Route::any('liveDel/{id}',"Live\LiveController@liveDel");//直播分类删除
    Route::any('liveEdit/{id}',"Live\LiveController@liveEdit");//直播分类修改页面
    Route::any('liveUpdate',"Live\LiveController@liveUpdate");//直播分类修改
    Route::any('delAll',"Live\LiveController@delAll");//直播分类修改
    Route::any('search',"Live\LiveController@search");//直播分类修改
    /*帮助中心*/
    Route::any('Help_show',"Help\HelpController@Help_show");//显示页面
    Route::any('Help_Add',"Help\HelpController@Help_Add");//新增
    Route::any('Help_Del/{id}',"Help\HelpController@Help_Del");//删除
    Route::any('Help_delall',"Help\HelpController@Help_delall");//批量删除
    Route::any('Help_Edit/{id}',"Help\HelpController@Help_Edit");//修改渲染
    Route::any('Help_Update',"Help\HelpController@Help_Update");//修改数据
    Route::any('Help_search',"Help\HelpController@Help_search");//搜索
    //图片管理
    Route::any('imageList',"Admin\ImageController@imageList");//图片列表
    Route::any('imageAdd',"Admin\ImageController@imageAdd");//图片添加
    Route::any('imageDel',"Admin\ImageController@imageDel");//图片删除
    Route::any('imageEdit',"Admin\ImageController@imageEdit");//图片修改
});
/*文章资讯管理*/
Route::group(['prefix'=>'article'], function(){
    Route::get('type',"Admin\ArticleController@type");//分类展示
    Route::any('insert',"Admin\ArticleController@insert");//分类添加
    Route::any('delete{id?}',"Admin\ArticleController@delete");//分类删除
    Route::any('change',"Admin\ArticleController@change");

    Route::get('index',"Admin\ArticleController@index");
    Route::any('store',"Admin\ArticleController@store");
    Route::any('del{id?}',"Admin\ArticleController@del");
    Route::get('edit{id?}',"Admin\ArticleController@edit");//跳转修改页面
    Route::any('doEdit',"Admin\ArticleController@doEdit");
    Route::any('checkdel',"Admin\ArticleController@checkdel");//执行批量删除
});
/*导航栏管理*/
Route::group(['prefix'=>'nav'], function(){
    Route::get('index',"Admin\NavController@index");//列表展示
    Route::any('insert',"Admin\NavController@insert");//添加导航名称
    Route::any('delete{id?}',"Admin\NavController@delete");//删除导航名称
    Route::get('edit{id?}',"Admin\NavController@edit");//跳转修改页面
    Route::any('doEdit',"Admin\NavController@doEdit");//执行修改
    Route::any('checkdel',"Admin\NavController@checkdel");//执行批量删除
});
/* 联系我们 */
Route::group(['prefix'=>'contact'], function(){
    Route::get('index',"Admin\ContactController@index");//列表展示
    Route::any('store',"Admin\ContactController@store");//添加联系的标题名称
    Route::get('edit{id?}',"Admin\ContactController@edit");//跳转修改页面
    Route::any('doEdit',"Admin\ContactController@doEdit");
    Route::any('delete{id?}',"Admin\ContactController@delete");
    Route::any('checkdel',"Admin\ContactController@checkdel");
});


