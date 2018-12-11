@extends('layout/header')
@section('content')
@endsection
<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane">
            <input class="layui-input" placeholder="分类名" name="cate_name">
            <a href="{{url("nav/insert")}}" class="layui-btn">增加</a>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" id="del">批量删除</button>
        <button class="layui-btn layui-btn" id="all">全选</button>
        <button class="layui-btn layui-btn" id="unselect">全不选</button>
        <button class="layui-btn layui-btn" id="reverse">反选</button>


        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
    </xblock>
    <table class="layui-table >
        {{csrf_field()}}
        <thead>
        <tr>
            <th width="20px"></th>
            <th width="70">ID</th>
            <th>导航名</th>
            <th width="50">父ID</th>
            <th width="50">URL</th>
            <th width="220">操作</th>
        </thead>
        @foreach($list as $v)
        <tr  >
            <td ><input type="checkbox" value="{{$v->id}}" class="in"></td>
            <td>{{$v->id}}</td>
            <td><a href="">{{str_repeat("--|",$v->level)}}{{$v->name}}</a></td>
            <td>{{$v->pid}}</td>
            <td>{{$v->url}}</td>
            <td class="td-manage">
                <a href="edit{{$v->id}}" class="layui-btn layui-btn">编辑</a>
                <a href="delete{{$v->id}}" class=" layui-btn layui-btn-danger">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    //全选
    $("#all").click(function(){
        $("table input").prop("checked",true)
    })
    // 全不选
    $("#unselect").click(function(){
        $("table input").prop("checked",false)
    })
    // 反选
    $("#reverse").click(function(){
        $(".in").each(function(){
            this.checked = !this.checked
        })
    })



    //批量删除
    $(function () {
        $("#del").click(function () {
            var opt = "";
            var _token=$("input[name='_token']").val();
            $("input[type='checkbox']").each(function () {
                if ($(this).is(":checked")) {
                    opt+=$(this).val()+",";
                }
            });
            opt=opt.substr(0,opt.length-1);
            $.ajax({
                url:"/nav/checkdel",
                type:"post",
                dataType:"json",
                data:{
                    id:opt,
                    _token:_token
                },
                success:function (re) {
                    if(re.code==200){
                        alert(re.data);
                        location.reload();
                    }else{

                    }
                }
            })
        })
    });




</script>

