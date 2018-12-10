@extends('layout/header')
@section('content')
@endsection
<body>
<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form" method="post" action="store" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>文章标题
            </label>
            <div class="layui-input-inline">
                <input type="text" name="new_name"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>文章内容
            </label>
            <div class="layui-input-inline">
                <input type="text"  name="new_content"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>文章分类
            </label>
            <div class="layui-input-inline">
                <select name="new_type" id="">
                    <option value="">为分类</option>
                    @foreach($art as $v)
                    <option value="{{$v['id']}}" class="layui-input" >{{$v['new_type']}}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>时间
            </label>
            <div class="layui-input-inline">
                <input type="date"  name="start_time"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit" class="layui-btn" value="添加">
        </div>
    </form>
</div>
<script>

</script>

</body>

