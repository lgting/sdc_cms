@extends('admin.layout')
@section('body')
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>{{__('roles.name')}}
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="name" lay-verify="required" value="{{$item->name}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('roles.permission')}}</label>
            <div class="layui-input-block">
            @foreach($permissionsOptions as $permissionsOptionKey => $permissionsOptionValue)
                <input type="checkbox" name="permissions[{{$permissionsOptionValue}}]"
                @if(in_array($permissionsOptionValue,$roleAsPermissions)) checked @endif
                 title="{{$permissionsOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="update" lay-submit="">
                {{__('users.update')}}
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

        //监听提交
        admin.item_update(form,"{{route('admin.roles.update',$item->id)}}")

    });
</script>
@endsection