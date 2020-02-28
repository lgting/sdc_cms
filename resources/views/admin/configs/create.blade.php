@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
<form class="layui-form">
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>{{__('configs.zh_name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_email" name="zh_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>{{__('configs.en_name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="en_name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>{{__('configs.data_type')}}
                </label>
                <div class="layui-input-block">
                <select name="data_type" lay-verify="required">
                    <option value="">请选择{{__('configs.data_type')}}</option>
                    @foreach($dataTypeOptions as $key => $item)
                    <option value="{{$key}}">{{$item}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">
                    <span class="x-red">*</span>{{__('configs.config_type')}}
                </label>
                <div class="layui-input-block">
                <select name="config_type" lay-verify="required">
                    <option value="">请选择{{__('configs.config_type')}}</option>
                    @foreach($configTypeOptions as $key => $item)
                    <option value="{{$key}}">{{$item}}</option>
                    @endforeach
                </select>
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('configs.value')}}
              </label>
              <div class="layui-input-block">
                <textarea name="value" placeholder="请输入{{__('configs.value')}}" class="layui-textarea"></textarea>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('configs.values')}}
              </label>
              <div class="layui-input-block">
                <textarea name="values" placeholder="请输入{{__('configs.values')}}" class="layui-textarea"></textarea>
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
    admin.item_create(form,"{{route('admin.configs.store')}}")
    
    
});
</script>
@endsection