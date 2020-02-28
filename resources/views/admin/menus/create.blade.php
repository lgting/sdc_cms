@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('menus.parent_id')}}</label>
            <div class="layui-input-block">
                <select name="parent_id" lay-verify="required">
                    <option value="0">顶级菜单</option>
                    @foreach($menusOptions as $menusOptionsValue)
                    <option value="{{$menusOptionsValue->id}}">{{$menusOptionsValue->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
               <span class="x-red">*</span> {{__('menus.title')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_email" name="title" lay-verify="required"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                {{__('menus.icon')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_username" name="icon" required=""
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                {{__('menus.sortable')}}
            </label>
            <div class="layui-input-block">
                <input type="number" id="L_username" name="sortable" required="" value="0"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span> {{__('menus.uri')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_username" name="uri" required=""
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.role')}}</label>
            <div class="layui-input-block">
            @foreach($rolesOptions as $rolesOptionValue)
                <input type="checkbox" name="roles[{{$rolesOptionValue}}]"
                 title="{{$rolesOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.permission')}}</label>
            <div class="layui-input-block">
            @foreach($permissionsOptions as $permissionsOptionValue)
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


        //监听提交
        admin.item_create(form,"{{route('admin.menus.store')}}")

    });
</script>
@endsection