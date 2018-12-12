<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="{{asset('Admin')}}/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('Admin')}}/css/font.css">
    <link rel="stylesheet" href="{{asset('Admin')}}/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('Admin')}}/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('Admin')}}/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane" method="post" action="{{url("search")}}">
          <input class="layui-input" placeholder="请输入分类名称" name="cate_name">
          <button class="layui-btn" >搜索</button>
        </form>
      </div>
      <blockquote class="layui-elem-quote">直播分类管理</blockquote>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a class="layui-btn" href="{{url('liveAdd')}}"><i class="layui-icon"></i>增加</a>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table ">
        <thead>
          <tr>
            <th width="20">
              <input type="checkbox" id="salAll" lay-skin="primary" >
            </th>
            <th width="70">ID</th>
            <th>分类名称</th>
            <th width="50">分类图片</th>
            <th width="50">添加时间</th>
            <th width="220">链接地址</th>
            <th width="220">操作</th>
        </thead>
        <tbody class="x-cate">
         @foreach($data as $k =>$v)
          <tr cate-id='5' fid='0' >
            <td>
              <input type="checkbox" lay-skin="primary" name="ids" value="{{$v->id}}">
            </td>
            <td>{{$v->id}}</td>
            <td>
              {{str_repeat('|-',$v->level)}}{{$v->video_name}}
            </td>
            <td> <img src="{{$v->video_image}}" width="50px" height="50px" title="{{$v->video_name}}"></td>
            <td width="200px">
              {{$v->create_time}}
            </td>
            <td width="200px">
              {{$v->video_link}}
            </td>
            <td class="td-manage">
              <a href="{{url('liveEdit',['id'=>"$v->id"])}}" class="layui-btn layui-btn-warm layui-btn-xs">编辑</a>
              {{--<button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="x_admin_show('编辑','admin-edit.html')" ><i class="layui-icon">&#xe642;</i>添加子栏目</button>--}}
              <a href="{{url('liveDel',['id'=>"$v->id"])}}" class="layui-btn layui-btn-warm layui-btn-xs">删除</a>
            </td>
          </tr>
           @endforeach
        </tbody>
      </table>

    </div>
  </body>
  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
      $('#salAll').click(function() {
          //全选全不选
          if ($(this).is(":checked")) {
              $("input[name='ids']").prop("checked", true);
          } else {
              $("input[name='ids']").prop("checked", false);
          }

      })
          //单删除事件  check_delete(参数)
          function delAll(){
              var str="";//定义一个空的值
              var id=document.getElementsByName('ids');//根据name值获取到复选框的元素
              var length=id.length;//获取它的长度
              for(i=0;i<length;i++){
                  //根据循环将选中的值用逗号拼接一下，注意：值如果取不出来的话，看看checkbox有没有书写value值，至关重要
                  if(id[i].checked){
                      str+=id[i].value+',';
                  }
                  // alert(str);//id获取到可以打印一下看看了，id取到了，底下ajax与之前一样
              }
              $.ajax({
                  type:"get",
                  url:"{{url('delAll')}}",
                  data:{
                      id:str
                  },success:function(e){
                      if(e==1){
                          alert("删除成功");
                          location.reload();
                      }else{
                          alert("删除失败");
                      }
                  }
              })
          }

  </script>
</html>