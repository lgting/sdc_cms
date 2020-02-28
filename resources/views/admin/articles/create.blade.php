@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
<form class="layui-form">
          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>{{__('articles.column id')}}
              </label>
              <div class="layui-input-block">
                <select name="column_id" disabled>
                @foreach($columnsOptions as $columnsOptionKey => $columnsOptionValue)
                    <option value="{{$columnsOptionValue['id']}}" 
                    @if($columnsOptionValue['id'] == $column->id) selected @endif
                    >{{$columnsOptionValue['name']}}</option>
                @endforeach
                </select>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  <span class="x-red">*</span>{{__('articles.model id')}}
              </label>
              <div class="layui-input-block">
                <select name="model_id" disabled>
                @foreach($modelsOptions as $modelsOptionKey => $modelsOptionValue)
                    <option value="{{$modelsOptionKey}}"
                    @if($modelsOptionKey == $column->model_id) selected @endif
                    >{{$modelsOptionValue}}</option>
                @endforeach
                </select>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">
                  <span class="x-red">*</span>{{__('articles.title')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_email" name="title" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('articles.keywords')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="keywords"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('articles.description')}}
              </label>
              <div class="layui-input-block">
                <textarea class="layui-textarea" name="description"></textarea>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('articles.thumb')}}
              </label>
              <div class="layui-input-block">
                <img src="" alt="{{__('articles.thumb')}}" class="image" id="imageImage">
                <button type="button" class="layui-btn" id="image">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <input type="hidden" name="thumb" id="imageHidden" value="" />

                <script>
                    layui.use(['upload','layer'], function(){
                        var imageUpload = layui.upload;
                        var layer = layui.layer
                        var imagenode = $('#imageHidden')
                        var imageImageNode = $('#imageImage')

                        //点击图片删除
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
                        //执行实例
                        var imageUploadInst = imageUpload.render({
                            elem: '#image' //绑定元素
                            ,url: '{{route('admin.articles.upload')}}' //上传接口
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
              <label for="L_username" class="layui-form-label">
                  {{__('articles.content')}}
              </label>
              <div class="layui-input-block">
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
                <script id="container" name="content" type="text/plain"></script>
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('articles.author')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="author"
                  autocomplete="off" class="layui-input">
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_username" class="layui-form-label">
                  {{__('articles.source')}}
              </label>
              <div class="layui-input-block">
                  <input type="text" id="L_username" name="source" 
                  autocomplete="off" class="layui-input">
              </div>
          </div>

            <div class="layui-form-item">
                <label for="attributes" class="layui-form-label">
                    <span class="x-red"> * </span>
                    {{__('articles.attributes')}}
                </label>
                <div class="layui-input-block">
                    @foreach($attributesOptions as $attributesOptionKey => $attributesOptionValue)
                    <input type="checkbox" name="attributes[{{$attributesOptionKey}}]"
                    @if($loop->first) checked @endif
                        title="{{$attributesOptionValue}}" value="{{$attributesOptionKey}}">
                    @endforeach
                </div>
            </div>

            @foreach($additionalFields as $additionalFieldsKey => $additionalFieldsValue)
                @switch($additionalFieldsValue->type)
                @case(App\Models\Field::TYPE_STRING)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <input type="text" id="L_email" name="additional_fields[{{$additionalFieldsValue->en_name}}]"
                                value="{{$additionalFieldsValue->values}}"
                            autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_RADIO)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                        @foreach(explode('|',$additionalFieldsValue->values) as $radioValuesKey => $radioValuesValue)
                            <input type="radio" name="additional_fields[{{$additionalFieldsValue->en_name}}]"
                            @if($loop->first) checked @endif
                                title="{{$radioValuesValue}}" value="{{$radioValuesKey}}">
                        @endforeach
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_CHECKBOX)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                        @foreach(explode('|',$additionalFieldsValue->values) as $checkboxValuesKey => $checkboxValuesValue)
                            <input type="checkbox" name="additional_fields[{{$additionalFieldsValue->en_name}}][{{$checkboxValuesKey}}]" 
                                title="{{$checkboxValuesValue}}">
                        @endforeach
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_TEXT)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <textarea name="additional_fields[{{$additionalFieldsValue->en_name}}]"
                            class="layui-textarea">{{$additionalFieldsValue->values}}</textarea>
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_FILE)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <img src="" alt="{{$additionalFieldsValue->zh_name}}" 
                            class="{{$additionalFieldsValue->en_name}}_image" 
                            id="{{$additionalFieldsValue->en_name}}_imageImage">
                            <button type="button" class="layui-btn" 
                            id="{{$additionalFieldsValue->en_name}}_image">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                            </button>
                            <input type="hidden" name="additional_fields[{{$additionalFieldsValue->en_name}}]" id="{{$additionalFieldsValue->en_name}}_imageHidden" value="" />

                            <script>
                                layui.use(['upload','layer'], function(){
                                    var imageUpload = layui.upload;
                                    var layer = layui.layer
                                    var imagenode = $('#{{$additionalFieldsValue->en_name}}_imageHidden')
                                    var imageImageNode = $('#{{$additionalFieldsValue->en_name}}_imageImage')

                                    // 点击图片删除该图片
                                    $('#{{$additionalFieldsValue->en_name}}_imageImage').on('click',function (){
                                        var This = this
                                        layer.confirm('确定移除栏目图片吗？',function (index){
                                            var file_name = $('input#{{$additionalFieldsValue->en_name}}_imageHidden').val();
                                            $('input#{{$additionalFieldsValue->en_name}}_imageHidden').val('');
                                            $(This).attr('src','')
                                            admin.delete_file("{{route('admin.indexs.destroy_file')}}",file_name);
                                            layer.close(index)
                                        })
                                    })
                                    //执行实例
                                    var imageUploadInst = imageUpload.render({
                                        elem: '#{{$additionalFieldsValue->en_name}}_image' //绑定元素
                                        ,url: '{{route('admin.articles.upload')}}' //上传接口
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

                    @break
                @case(App\Models\Field::TYPE_INT)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="additional_fields[{{$additionalFieldsValue->en_name}}]"  lay-verify="integer"
                            class="layui-input" value="{{$additionalFieldsValue->values}}"></input>
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_FLOAT)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <input type="text" name="additional_fields[{{$additionalFieldsValue->en_name}}]"  lay-verify="number"
                            class="layui-input" value="{{$additionalFieldsValue->values}}"></input>
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_SELECT)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <select name="additional_fields[{{$additionalFieldsValue->en_name}}]">
                            @foreach(explode('|',$additionalFieldsValue->values) as $selectValuesKey => $selectValuesValue)
                                <option value="{{$selectValuesKey}}">{{$selectValuesValue}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    @break
                @case(App\Models\Field::TYPE_EDITOR)
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            {{$additionalFieldsValue->zh_name}}
                        </label>
                        <div class="layui-input-block">
                            <script type="text/javascript">
                                var ue = UE.getEditor('{{$additionalFieldsValue->en_name}}_container',{
                                    initialFrameHeight:300
                                });
                                ue.ready(function() {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });
                            </script>

                            <!-- 编辑器容器 -->
                            <script id="{{$additionalFieldsValue->en_name}}_container" name="additional_fields[{{$additionalFieldsValue->en_name}}]" type="text/plain"></script>
                        </div>
                    </div>

                    @break
                @default

                @endswitch
            @endforeach

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  {{__('admin.create')}}
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
    form.verify({
        integer: function (value,item){
            console.log(value);
            if(! /^\d+$/.test(value)){
                return '必须是整数';
            }
        }
    })

    //表单提交
    admin.item_create(form,"{{route('admin.articles.store',[
        'column'=>$column->id,
        'model'=>$column->model_id,
    ])}}")
    
    
});
</script>
@endsection