@extends('admin.layout')
@section('body')
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>{{__('permissions.name')}}
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_username" name="name" lay-verify="required" value="{{$item->name}}"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">{{__('permissions.http methods')}}</label>
            <div class="layui-input-block">
            @php
                $checkedHttpMotheds = explode('|',$item->http_methods);
            @endphp
            @foreach($httpMothedsOptions as $httpMothedsOptionKey => $httpMothedsOptionValue)
                <input type="checkbox" name="http_methods[{{$httpMothedsOptionKey}}]"
                    @if(in_array($httpMothedsOptionKey,$checkedHttpMotheds)) checked @endif
                 title="{{$httpMothedsOptionValue}}">
            @endforeach
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">{{__('permissions.http paths')}}</label>
            <div class="layui-input-block">
                <textarea name="http_paths" placeholder="请输入{{__('permissions.http paths')}}" class="layui-textarea">{{$item->http_paths}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="update" lay-submit="">
                {{__('permissions.update')}}
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
        admin.item_update(form,"{{route('admin.permissions.update',$item->id)}}")

    });
</script>
@endsection