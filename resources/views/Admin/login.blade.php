@extends('layout/header')
@section('content')
@endsection
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        
        <div class="message">@if(Session::has('msg')){{Session::get('msg')}}@else管理登录@endif</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="{{url('login')}}">
            {{csrf_field()}}
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
              // layer.msg('玩命卖萌中', function(){
              //   //关闭后的操作
              //   });
              //监听提交
              form.on('submit(login)', function(data){
                // alert(888)
                layer.msg(JSON.stringify(data.field),function(){
                    location.href='index.html'
                });
                return false;
              });
            });
        })

        
        
    </script>

    
    <!-- 底部结束 -->

</body>
</html>