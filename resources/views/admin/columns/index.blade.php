@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{route('admin.indexs.welcome')}}">{{__('admin.homepage')}}</a>
        <a href="{{route('admin.columns.index')}}">{{__('admin.website_config')}}</a>
        <a>
          <cite>{{__('admin.column_list')}}</cite>
        </a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    
    <div class="x-body">
      <xblock>
        <button class="layui-btn" 
          onclick="x_admin_show('{{__('columns.create')}} ','{{route('admin.columns.create')}}')"
         ><i class="layui-icon"></i>添加</button>
      </xblock>
      <table class="layui-table layui-form">
        <thead>
          <tr>
            <th width="20">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th width="70">ID</th>
            <th>栏目名</th>
            <th>栏目模型</th>
            <th width="50">排序</th>
            <th width="50">状态</th>
            <th width="220">操作</th>
        </thead>
        <tbody class="x-cate">
          @foreach($columns as $columnKey => $columnValue)
          <tr cate-id='{{$columnValue["id"]}}' fid='{{$columnValue["parent_id"]}}' >
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$columnValue['id']}}</td>
            <td>
              <i class="layui-icon x-show" status='true'>&#xe623;</i>
              {{$columnValue['name']}}
            </td>
            <td>
            @if(array_key_exists($columnValue['model_id'],$modelsOptions))
              {{$modelsOptions[$columnValue['model_id']]}}
            @else
              模型不存在
            @endif
            </td>
            <td><input type="text" class="layui-input x-sort" name="order" value="{{$columnValue['sortable']}}"></td>
            <td>
              {{$statusOptions[$columnValue['status']]}}
            </td>
            <td class="td-manage">
              <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="location.href='{{route('admin.articles.index',['column'=>$columnValue['id']])}}'" ><i class="layui-icon">&#xe642;</i>查看文档</button>
              <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','{{route('admin.columns.edit',$columnValue['id'])}}')" ><i class="layui-icon">&#xe642;</i>编辑</button>
              <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="admin.item_del(this,'{{route('admin.columns.destroy',$columnValue['id'])}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
</div>
@endsection
@section('script')
<script>
layui.use(['form'], function(){
  form = layui.form;
  
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