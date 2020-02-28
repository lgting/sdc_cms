@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <div  class="layui-tab ">
        <ul class="layui-tab-title">
            <li class="layui-this">{{__('columns.base_info')}}</li>
            <li>{{__('columns.seo_setting')}}</li>
            <li>{{__('columns.content')}}</li>
        </ul>
        <form class="layui-tab-content layui-form">
            <div class="layui-tab-item layui-show">

                <div class="layui-form-item">
                    <label for="parent_id" class="layui-form-label">
                        <span class="x-red"> * </span>
                    {{__('columns.parent_id')}}
                    </label>
                    <div class="layui-input-inline">
                        <select name="parent_id" id="parent_id">
                            <option value="0">顶级栏目</option>
                            @foreach($columns as $columnKey => $columnValue)
                            <option value="{{$columnValue['id']}}" @if($item->parent_id == $columnValue['id']) selected @endif>{{$columnValue['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="model_id" class="layui-form-label">
                        <span class="x-red"> * </span>
                    {{__('columns.model_id')}}
                    </label>
                    <div class="layui-input-inline">
                        <select name="model_id" id="parent_id">
                        @foreach($modelsOptions as $modelsOptionKey => $modelsOptionValue)
                            <option value="{{$modelsOptionKey}}" @if($item->model_id == $modelsOptionKey) selected @endif >{{$modelsOptionValue}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red"> * </span>
                        {{__('columns.name')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="name" id="name" value='{{$item->name}}'
                         class="layui-input" >
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
                        @if($item->status == $statusOptionKey) checked @endif
                         title="{{$statusOptionValue}}" value="{{$statusOptionKey}}">
                        @endforeach
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="image" class="layui-form-label">
                        {{__('columns.image')}}
                    </label>
                    <div class="layui-input-block">
                        <img src="/storage/{{$item->image}}" alt="{{__('columns.image')}}" class="image" id="imageImage">
                        <button type="button" class="layui-btn" id="image">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>
                        <input type="hidden" name="image" id="imageHidden" value="{{$item->image}}" />

                        <script>
                            layui.use(['upload','layer'], function(){
                                var imageUpload = layui.upload;
                                var layer = layui.layer
                                var imagenode = $('#imageHidden')
                                var imageImageNode = $('#imageImage')
                                //执行实例
                                var imageUploadInst = imageUpload.render({
                                    elem: '#image' //绑定元素
                                    ,url: '{{route('admin.columns.upload')}}' //上传接口
                                    ,data:{key: "image" }
                                    ,exts:"jpg|png|jpeg"
                                    ,done: function(res){
                                        if(res.code == 201) {
                                            imagenode.val(res.data.src)
                                            imageImageNode.attr('src','/storage/'+res.data.src)
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

                <div class="layui-form-item">
                    <label for="attributes" class="layui-form-label">
                        <span class="x-red"> * </span>
                        {{__('columns.attributes')}}
                    </label>
                    <div class="layui-input-block">
                        @foreach($attributesOptions as $attributesOptionKey => $attributesOptionValue)
                        <input type="radio" name="attributes"
                        @if($item->attributes == $attributesOptionKey) checked @endif
                         title="{{$attributesOptionValue}}" value="{{$attributesOptionKey}}">
                        @endforeach
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="channel_template" class="layui-form-label">
                        {{__('columns.channel_template')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="channel_template" id="channel_template"
                            value="{{$item->channel_template}}"
                         class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="list_template" class="layui-form-label">
                        {{__('columns.list_template')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="list_template" id="list_template"
                            value="{{$item->list_template}}"
                         class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="content_template" class="layui-form-label">
                        {{__('columns.content_template')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="content_template" id="content_template"
                            value="{{$item->content_template}}"
                         class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="redirect_url" class="layui-form-label">
                        {{__('columns.redirect_url')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="redirect_url" id="redirect_url"
                            value="{{$item->redirect_url}}"
                         class="layui-input" >
                    </div>
                </div>

            </div>
            <div class="layui-tab-item">

                <div class="layui-form-item">
                    <label for="seo_title" class="layui-form-label">
                        {{__('columns.seo_title')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="seo_title" id="seo_title" value="{{$item->seo_title}}"
                         class="layui-input" >
                    </div>
                </div>
                
                <div class="layui-form-item">
                    <label for="seo_keywords" class="layui-form-label">
                        {{__('columns.seo_keywords')}}
                    </label>
                    <div class="layui-input-block">
                        <input type="text" name="seo_keywords" id="seo_keywords" value="{{$item->seo_keywords}}"
                         class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label for="seo_description" class="layui-form-label">
                        {{__('columns.seo_description')}}
                    </label>
                    <div class="layui-input-block">
                        <textarea name="seo_description" id="seo_description" class="layui-textarea">{{$item->seo_description}}</textarea>
                    </div>
                </div>

            </div>
            <div class="layui-tab-item">
                @include('vendor.ueditor.assets')
                <script type="text/javascript">
                    var ue = UE.getEditor('container',{
                        initialFrameHeight:300
                    });
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>

                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain">{!! $item->content !!}</script>
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
</div>
@endsection
@section('script')
<script>


layui.use(['form','layer'], function(){
    $ = layui.jquery;
    var form = layui.form
    ,layer = layui.layer;


    //表单提交
    admin.item_update(form,"{{route('admin.columns.update',$item->id)}}")

    // 移除图片
    $('#imageImage').on('click',function (){
        var This = this
        layer.confirm('确定移除栏目图片吗？',function (index){
            var file_name = $('input#imageHidden').val();
            $('input#imageHidden').val('');
            $(This).attr('src','')
            admin.delete_file("{{route('admin.indexs.destroy_file')}}",file_name);
            layer.close(index)
        })
    })
    
    
});
</script>
@endsection