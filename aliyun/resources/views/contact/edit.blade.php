@extends('layout/header')
@section('content')
@endsection
<body>

<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form" method="post" action="doEdit" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$info->id}}">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>联系标题
            </label>
            <div class="layui-input-inline">
                <input type="text" name="name" value="{{$info->name}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>联系图片
            </label>
            <div class="layui-input-inline">
                <input type="file" class="layui-input" name="image" value="{{$info->image}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>URL
            </label>
            <div class="layui-input-inline">
                <input type="text" name="contact_url"  class="layui-input" value="{{$info->contact_url}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>备注
            </label>
            <div class="layui-input-inline">
                <input type="text"  name="remarks"  class="layui-input" value="{{$info->remarks}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <input type="submit" class="layui-btn" value="修改">
        </div>
    </form>
</div>


</body>

