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
    <script type="text/javascript" src="{{asset('Admin')}}//js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body layui-anim layui-anim-up">
        <form class="layui-form" method="post" action="{{url("liveUpdate")}}" enctype="multipart/form-data">
          <div class="layui-form-item">
              <input type="hidden" name="id" value="{{$data->id}}">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>上级分类
              </label>
              <div class="layui-input-inline">
              <select id="L_email" name="pid">
                  <option value="0">顶级分类</option>
                  @foreach($info as $k =>$v)
                      <option value="{{$v->id}}"@if($v->id==$data->pid)selected="selected"@endif>
                      >{{$v->video_name}}</option>
                  @endforeach
              </select>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>分类名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_username" name="video_name" value="{{$data->video_name}}" required="" lay-verify="nikename"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>图片
                </label>
                <div class="layui-input-inline">
                    <input type="hidden" name="video_image" value="{{$data->video_image}}">
                    <input type="file" id="L_username" name="file_image"  lay-verify="nikename" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>链接地址
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_username" name="video_link" value="{{$data->video_link}}" required="" lay-verify="nikename"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
                  <input class="layui-btn" lay-filter="add" lay-submit="" type="submit" value="修改">
          </div>
      </form>
    </div>
  </body>
</html>