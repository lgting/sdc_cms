@if(\Auth::user()->can('view',\App\Models\Menu::where('id',$item['id'])->first()))
<li>
    <a href="javascript:;">
        <i class="iconfont">{!!$item['icon']!!}</i>
        <cite>{{$item['title']}}</cite>
        <i class="iconfont nav_right"></i>
    </a>
    <ul class="sub-menu">
        @foreach($item['children'] as $childrenValue)
        @if(\Auth::user()->can('view',\App\Models\Menu::where('id',$childrenValue['id'])->first()))
        <li>
            <a _href="{{admin_route_prefix().'/'.$childrenValue['uri']}}">
                <i class="iconfont">{!!$childrenValue['icon']!!}</i>
                <cite>{{$childrenValue['title']}}</cite>
            </a>
        </li>
        @endif
        @endforeach
    </ul>
</li>
@endif