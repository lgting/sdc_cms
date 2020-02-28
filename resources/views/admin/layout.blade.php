<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('x_admin/css/font.css')}}">
        <link rel="stylesheet" href="{{asset('x_admin/css/xadmin.css')}}">
        <link rel="stylesheet" href="{{asset('css/admin/base.css')}}">
        <script type="text/javascript" src="{{asset('js/jquery.3.2.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('x_admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script type="text/javascript" src="{{asset('x_admin/js/xadmin.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>


        @yield('header')
    </head>
    <body class="@yield('body_class')">

    @yield('body')

    @yield('script')

    
    </body>
</html>