@extends('layout/header')
@section('content')
@endsection
<body>
<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form" method="post" action="{{url("nav/doEdit")}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="{{$list->id}}" name="id">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>导航名称
            </label>
            <div class="layui-input-inline">
                <input type="text" name="name"  class="layui-input" value="{{$list->name}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>父级ID
            </label>
            <div class="layui-input-inline">
                <input type="text"  name="pid"  class="layui-input" value="{{$list->pid}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>URL链接
            </label>
            <div class="layui-input-inline">
                <input type="text"  name="url"  class="layui-input" value="{{$list->url}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit" class="layui-btn" value="修改">
        </div>
    </form>
</div>
<script>

</script>

</body>

