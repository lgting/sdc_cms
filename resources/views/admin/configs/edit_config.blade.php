@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{route('admin.indexs.welcome')}}">{{__('admin.homepage')}}</a>
        <a href="{{route('admin.configs.index')}}">{{__('admin.website_config')}}</a>
        <a>
          <cite>{{__('admin.config_manage')}}</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="layui-tab">
        <ul class="layui-tab-title">
        @foreach($configTypeOptions as $key => $value)
            <li @if($loop->first) class="layui-this" @endif>{{$value}}</li>
        @endforeach
        </ul>
        <form class="layui-tab-content layui-form">
            {{-- base info setting --}}
            @foreach($configTypeOptions as $key => $value)
            <div class="layui-tab-item @if($loop->first) layui-show @endif">

                @foreach($items as $keyOne => $levelOne)
                    @if ($levelOne->config_type == $key && $levelOne->data_type == 0)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <input type="text"  name="{{$levelOne->en_name}}" 
                            autocomplete="off" value="{{$levelOne->value}}" class="layui-input">
                        </div>
                    </div>
                    @endif

                    @if ($levelOne->config_type == $key && $levelOne->data_type == 1)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            @php
                                $radios = explode('|',$levelOne->values);
                            @endphp
                            @foreach($radios as $radioKey => $radioValue)
                            <input type="radio" name="{{$levelOne->en_name}}" value="{{$radioKey}}" 
                                @if($levelOne->value == $radioKey) checked @endif
                            title="{{$radioValue}}">
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if ($levelOne->config_type == $key && $levelOne->data_type == 2)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            @php
                                $checkboxs = explode('|',$levelOne->values);
                                $defaultValues = explode('|',$levelOne->value);
                            @endphp
                            @foreach($checkboxs as $checkboxsKey => $checkboxValue)
                            <input type="checkbox" name="{{$levelOne->en_name}}[{{$checkboxsKey}}]" 
                                @if(in_array($checkboxsKey,$defaultValues)) checked @endif
                            title="{{$checkboxValue}}">
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if ($levelOne->config_type == $key && $levelOne->data_type == 3)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-inline">
                            <select name="{{$levelOne->en_name}}">
                            @php
                                $selectOptions = explode('|',$levelOne->values);
                            @endphp
                            @foreach($selectOptions as $selectOptionKey => $selectOptionValue)
                                <option value="{{$selectOptionKey}}" 
                                    @if($levelOne->value == $selectOptionKey) selected @endif
                                >{{$selectOptionValue}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if ($levelOne->config_type == $key && $levelOne->data_type == 4)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <textarea name="{{$levelOne->en_name}}" placeholder="请输入内容" class="layui-textarea">{{$levelOne->value}}</textarea>
                        </div>
                    </div>
                    @endif

                    @if ($levelOne->config_type == $key && $levelOne->data_type == 5)
                    <div class="layui-form-item">
                        <label for="{{$levelOne->en_name}}" class="layui-form-label">
                            {{$levelOne->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <img src="/storage/{{$levelOne->value}}" alt="{{$levelOne->zh_name}}" class="image" id="{{$levelOne->en_name}}Image">
                            <button type="button" class="layui-btn" id="{{$levelOne->en_name}}">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                            </button>
                            <input type="hidden" name="{{$levelOne->en_name}}" id="{{$levelOne->en_name}}Hidden" value="{{$levelOne->value}}" />

                            <script>
                                layui.use(['upload','layer'], function(){
                                    var {{$levelOne->en_name}}Upload = layui.upload;
                                    var layer = layui.layer
                                    var {{$levelOne->en_name}}node = $('#{{$levelOne->en_name}}Hidden')
                                    var {{$levelOne->en_name}}ImageNode = $('#{{$levelOne->en_name}}Image')
                                    //执行实例
                                    var {{$levelOne->en_name}}UploadInst = {{$levelOne->en_name}}Upload.render({
                                        elem: '#{{$levelOne->en_name}}' //绑定元素
                                        ,url: '{{route('admin.configs.upload')}}' //上传接口
                                        ,data:{key: "{{$levelOne->en_name}}" }
                                        ,exts:"jpg|png|jpeg"
                                        ,done: function(res){
                                            if(res.code == 201) {
                                                {{$levelOne->en_name}}node.val(res.data.src)
                                                {{$levelOne->en_name}}ImageNode.attr('src','/storage/'+res.data.src)
                                                layer.msg(res.msg)
                                            }
                                        }
                                        ,error: function(){
                                            layer.msg('上传失败')
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>
            @endforeach

            <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">
                </label>
                <button  class="layui-btn" lay-filter="save" lay-submit="">
                    {{__('admin.save')}}
                </button>
            </div>

        </form>
    </div>
</div>
 
@endsection
@section('script')
<script>
    layui.use(['form','layer','element'], function(){
        $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
        
        //监听提交
        form.on('submit(save)', function(data){
            var form = data.field
            $.ajax({
                url: "{{route('admin.configs.save_config')}}",
                type:"POST",
                data:form,
                success : function (res){
                    if (res.status == 200){
                        layer.alert(res.message, {icon: 6},function () {
                            // 获得frame索引
                            location.reload()
                        });
                    }else{
                        layer.msg('操作失败')
                    }
                }
            })
            return false;
        });
          
          
        });
</script>
@endsection