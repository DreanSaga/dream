@extends('layout/header')
@section('content')
@endsection  
  <body>
    <div class="x-body">
        <form  method="post" action="{{url('imageAdd')}}" enctype="multipart/form-data">
          {{csrf_field()}}

             <div class="layui-form-item">
              <label for="image_name" class="layui-form-label">
                  <span class="x-red">*</span>图片名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="image_name" name="image_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>


        
              <label for="file" class="layui-form-label">
                  <span class="x-red">*</span>选择图片
              </label>
              <div class="layui-input-inline">
                  <input type="file" id="image" name="images" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
        


          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>链接地址
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="link" name="link" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="sort" class="layui-form-label">
                  <span class="x-red">*</span>排序
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="sort" name="sort" required="" lay-verify="sort"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

        
          </div>
 
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="submiy">
                  增加
              </button>
          </div>
      </form>
    </div>
  
  </body>

</html>