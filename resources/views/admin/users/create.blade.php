@extends('admin.layout')
@section('body')
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="name" lay-verify="required"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>昵称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="nickname" required="" lay-verify="nikename"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>{{__('users.password')}}
            </label>
            <div class="layui-input-inline">
                <input type="password" id="L_pass" name="password" lay-verify="required"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
                <span class="x-red">*</span>{{__('users.repassword')}}
            </label>
            <div class="layui-input-inline">
                <input type="password" id="L_repass" name="repass" lay-verify="repass|required"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.role')}}</label>
            <div class="layui-input-block">
            @foreach($rolesOptions as $rolesOptionKey => $rolesOptionValue)
                <input type="checkbox" name="roles[{{$rolesOptionValue}}]"
                 title="{{$rolesOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.permission')}}</label>
            <div class="layui-input-block">
            @foreach($permissionsOptions as $permissionsOptionKey => $permissionsOptionValue)
                <input type="checkbox" name="permissions[{{$permissionsOptionValue}}]"
                 title="{{$permissionsOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                {{__('users.create')}}
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

        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 2){
                    return '昵称至少得2个字符';
                }
            }
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
        });

        //监听提交
        admin.item_create(form,"{{route('admin.users.store')}}")

    });
</script>
@endsection