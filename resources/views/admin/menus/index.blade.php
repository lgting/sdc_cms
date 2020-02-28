@extends('admin.layout')
@section('body')
<div class="x-body layui-anim layui-anim-up">
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="{{route('admin.indexs.welcome')}}">{{__('admin.homepage')}}</a>
        <a href="{{route('admin.menus.index')}}">{{__('admin.menu_manage')}}</a>
        <a>
          <cite>{{__('admin.menu_list')}}</cite>
        </a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    
    <div class="x-body">
      <xblock>
        <button class="layui-btn" 
          onclick="x_admin_show('{{__('menus.create')}} ','{{route('admin.menus.create')}}')"
         ><i class="layui-icon"></i>添加</button>
      </xblock>
      <table class="layui-table layui-form">
        <thead>
          <tr>
            <th width="20">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th width="70">ID</th>
            <th>{{__('menus.title')}}</th>
            <th>{{__('menus.uri')}}</th>
            <th width="50">{{__('menus.sortable')}}</th>
            <th width="220">操作</th>
        </thead>
        <tbody class="x-cate">
          @foreach($menus as $menuKey => $menuValue)
          <tr cate-id='{{$menuValue["id"]}}' fid='{{$menuValue["parent_id"]}}' >
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$menuValue['id']}}</td>
            <td>
              <i class="layui-icon x-show" status='true'>&#xe623;</i>
              {{$menuValue['title']}}
            </td>
            <td>
              {{$menuValue['uri']}}
            </td>
            <td><input type="text" class="layui-input x-sort" name="order" value="{{$menuValue['sortable']}}"></td>
            <td class="td-manage">
              <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('编辑','{{route('admin.menus.edit',$menuValue['id'])}}')" ><i class="layui-icon">&#xe642;</i>编辑</button>
              <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="admin.item_del(this,'{{route('admin.menus.destroy',$menuValue['id'])}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
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