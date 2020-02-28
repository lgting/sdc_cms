@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{route('admin.indexs.welcome')}}">{{__('admin.homepage')}}</a>
        <a href="{{route('admin.configs.index')}}">{{__('admin.website_config')}}</a>
        <a>
          <cite>{{__('admin.config_list')}}</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('{{__('configs.add')}}','{{route('admin.configs.create')}}')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">{{__('admin.count_datas')}} ：{{$pagination->count()}} 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>{{__('admin.id')}}</th>
            <th>{{__('configs.zh_name')}}</th>
            <th>{{__('configs.en_name')}}</th>
            <th>{{__('configs.config_type')}}</th>
            <th>{{__('configs.data_type')}}</th>
            <th>{{__('admin.operation')}}</th>
        </thead>
        <tbody>
          @foreach($pagination as $key => $item)
          <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$item->id}}</td>
            <td>{{$item->zh_name}}</td>
            <td>{{$item->en_name}}</td>
            <td>{{$configTypeOptions[$item['config_type']]}}</td>
            <td>{{$dataTypeOptions[$item['data_type']]}}</td>
            <td class="td-manage">
              <a title="编辑"  onclick="x_admin_show('编辑','{{route('admin.configs.edit',$item->id)}}')" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>
              <a title="删除" onclick="admin.item_del(this,'{{route('admin.configs.destroy',$item->id)}}')" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{$pagination->links()}}
    </div>
</div>
@endsection
@section('script')
<script>
layui.use('laydate', function(){
    var laydate = layui.laydate;
    
    //执行一个laydate实例
    laydate.render({
        elem: '#start' //指定元素
    });

    //执行一个laydate实例
    laydate.render({
        elem: '#end' //指定元素
    });
    });




    function delAll (argument) {

    var data = tableCheck.getData();

    layer.confirm('确认要删除吗？'+data,function(index){
        //捉到所有被选中的，发异步进行删除
        layer.msg('删除成功', {icon: 1});
        $(".layui-form-checked").not('.header').parents('tr').remove();
    });
}
</script>
@endsection