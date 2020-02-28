@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('menus.parent_id')}}</label>
            <div class="layui-input-block">
                <select name="parent_id" lay-verify="required">
                    <option value="0">顶级栏目</option>
                    @foreach($menusOptions as $menusOptionsValue)
                    <option value="{{$menusOptionsValue->id}}"
                        @if($item->parent_id == $menusOptionsValue->id) selected @endif
                    >{{$menusOptionsValue->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
               <span class="x-red">*</span> {{__('menus.title')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_email" name="title" lay-verify="required" value="{{$item->title}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                {{__('menus.icon')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_username" name="icon" required="" value="{{$item->icon}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                {{__('menus.sortable')}}
            </label>
            <div class="layui-input-block">
                <input type="number" id="L_username" name="sortable" required="" value="{{$item->sortable}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span> {{__('menus.uri')}}
            </label>
            <div class="layui-input-block">
                <input type="text" id="L_username" name="uri" required="" value="{{$item->uri}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.role')}}</label>
            @php
                $rolesChecked = $item->roles()->pluck('name')->toArray();
            @endphp
            <div class="layui-input-block">
            @foreach($rolesOptions as $rolesOptionValue)
                <input type="checkbox" name="roles[{{$rolesOptionValue}}]"
                    @if(in_array($rolesOptionValue,$rolesChecked)) checked @endif
                 title="{{$rolesOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('users.permission')}}</label>
            <div class="layui-input-block">
            @php
                $permissionsChecked = explode('|',$item->permission);
            @endphp
            @foreach($permissionsOptions as $permissionsOptionValue)
                <input type="checkbox" name="permissions[{{$permissionsOptionValue}}]"
                    @if(in_array($permissionsOptionValue,$permissionsChecked)) checked @endif
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
        admin.item_update(form,"{{route('admin.menus.update',$item->id)}}")

    });
</script>
@endsection