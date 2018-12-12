@extends('layout/header')
@section('content')
@endsection
  <body>
    <div class="x-nav">
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
   
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <a class="layui-btn" href='{{url("imageAdd")}}' )"><i class="layui-icon"></i>添加</a>
        <h3>@if(Session::has('msg')){{Session::get('msg')}}@endif</h3>
        <span class="x-right" style="line-height:40px">共有数据：{{$result['count']}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>编号</th>
            <th>图片</th>
            <th>添加时间</th>
            <th >操作</th>
            </tr>
        </thead>
        <tbody>
          @foreach($result['dataList'] as $k => $v)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$v->id}}</td>
            <td>
              <a href="{{$v->img_link}}">
                <img src="{{$v->img_path}}" title="{{$v->img_name}}" width="25">
              </a>
            </td>
            <td>{{$v->create_time}}</td>
            
            <td class="td-manage">
              <a title="编辑"   href="/imageEdit?id={{$v->id}}">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除"  href="/imageDel?id={{$v->id}}">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="page">
        <div>
          {{$result['dataList']->render()}}
        </div>
      </div>

    </div>
   
  </body>

</html>