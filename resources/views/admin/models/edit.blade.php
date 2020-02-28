@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
<form class="layui-form">
          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>{{__('models.name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_email" name="name" required="" lay-verify="required"
                    value="{{$item->name}}"
                  autocomplete="off" class="layui-input">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>{{__('models.table name')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="table_name" required="" lay-verify="required"
                    value="{{$item->table}}"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">
                    <span class="x-red"> * </span>
                    {{__('columns.status')}}
                </label>
                <div class="layui-input-block">
                @foreach($statusOptions as $statusOptionKey => $statusOptionValue)
                    <input type="radio" name="status"
                        title="{{$statusOptionValue}}" value="{{$statusOptionKey}}" @if($item->status == $statusOptionKey) checked @endif>
                @endforeach
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="update" lay-submit="">
                {{__('admin.edit')}}
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
    admin.item_update(form,"{{route('admin.models.update',$item->id)}}")
    
    
});
</script>
@endsection