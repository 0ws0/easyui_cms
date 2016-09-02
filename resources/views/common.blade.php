<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>我的后台</title>
    <link href="{{asset('css/default.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('js/themes/default/easyui.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('js/themes/icon.css')}}"/>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.easyui.min.js')}}"></script>
</head>
@yield('content')
</html>
