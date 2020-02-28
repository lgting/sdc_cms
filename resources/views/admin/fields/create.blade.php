@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
<form class="layui-form">
            <div class="layui-form-item">
                <label for="status" class="layui-form-label">
                    <span class="x-red"> * </span>
                    {{__('fields.model id')}}
                </label>
                <div class="layui-input-block">
                    <select name="model_id" lay-verify="required">
                    @foreach($modelOptions as $modelOptionKey => $modelOptionValue)
                        <option value="{{$modelOptionKey}}">{{$modelOptionValue}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>{{__('fields.zh name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_email" name="zh_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>{{__('fields.en name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="en_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">
                    <span class="x-red"> * </span>
                    {{__('fields.type')}}
                </label>
                <div class="layui-input-block">
                    <select name="type" lay-verify="required">
                    @foreach($typeOptions as $typeOptionKey => $typeOptionValue)
                        <option value="{{$typeOptionKey}}">{{$typeOptionValue}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">
                    <span class="x-red"> * </span>
                    {{__('fields.values')}}
                </label>
                <div class="layui-input-block">
                    <textarea name="values" id="seo_description" class="layui-textarea"></textarea>
                </div>
            </div>


          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
</div>
@endsection
@section('script')
<script>
layui.use(['form','layer'], function(){
    $ = layui.jquery;
    var form = layui.form
    ,layer = layui.layer;

    //表单提交
    admin.item_create(form,"{{route('admin.fields.store')}}")
    
    
});
</script>
@endsection