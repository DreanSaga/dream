@extends('layout/header')
@section('contend')
@endsection
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <blockquote class="layui-elem-quote">欢迎管理员：
            <span class="x-red">{{Session::get('userinfo')['username']}}</span>！
            当前时间:<span id="current-time"></span>
            </blockquote>
        

        <fieldset class="layui-elem-field">
            <legend>系统信息</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>系统版本</th>
                            <td>V1.1.0</td></tr>
                        <tr>
                            <th>服务器地址</th>
                            <td>five.haoyunyun.cn</td></tr>
                        <tr>
                            <th>操作系统</th>
                            <td>WINNT</td></tr>
                        <tr>
                            <th>运行环境</th>
                            <td>Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9</td></tr>
                        <tr>
                            <th>PHP版本</th>
                            <td>7.2.10-nts</td></tr>
                            <th>MYSQL版本</th>
                            <td>5.5.53</td></tr>
                        <tr>
                            <th>Laravel</th>
                            <td>5.7</td></tr>
                        <tr>
                            <th>上传附件限制</th>
                            <td>2M</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>PHP-1803A-第五组</td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>PHP-1803A-第五组</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <blockquote class="layui-elem-quote layui-quote-nm">本系统由PHP-1803A-第五组 提供技术支持。</blockquote>
    </div>
    </body>
    <script src="{{asset('Admin')}}/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        //时间
         setInterval(function() {
              var now = (new Date()).toLocaleString();
              $('#current-time').html(now);
          }, 1000)
    </script>
</html>