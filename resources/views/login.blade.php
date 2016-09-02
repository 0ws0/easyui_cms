@extends('common')
@section('content')
    <body>
    <div id="loginWin" class="easyui-window" title="登录" style="width:350px;height:188px;padding:5px;" minimizable="false" maximizable="false" resizable="false" collapsible="false">
        <div class="easyui-layout" fit="true">
            <div region="center" border="false" style="padding:5px;background:#fff;border:1px solid #ccc;">
                <form id="loginForm" method="post">
                    <div style="padding:5px 0;">
                        <label for="login">帐号:</label>
                        <input type="text" name="login" style="width:260px;" />
                    </div>
                    <div style="padding:5px 0;">
                        <label for="password">密码:</label>
                        <input type="password" name="password" style="width:260px;" />
                    </div>
                    <div style="padding:5px 0;text-align: center;color: red;" id="showMsg"></div>
                </form>
            </div>
            <div region="south" border="false" style="text-align:right;padding:5px 0;">
                <a class="easyui-linkbutton" iconcls="icon-ok" href="javascript:void(0)" onclick="login()">登录</a>
            </div>
        </div>
    </div>
    </body>
@stop