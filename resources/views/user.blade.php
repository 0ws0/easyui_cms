@extends('common')
@section('content')
    <body>

    <table id="dg" class="easyui-datagrid"
           url="user"
           method="get"
           toolbar="#toolbar" pagination="true"
           rownumbers="true" fitColumns="true" fit="true">
        <thead>
        <tr>
            <th checkbox="true" field="" width="50"></th>
            <th field="u_id" width="50">用户ID</th>
            <th field="u_name" width="50">用户名</th>
            <th field="u_phone" width="50">手机号</th>
            <th field="u_email" width="50">邮箱</th>
            <th field="u_status" width="50">用户状态</th>
            <th field="u_create_time" width="50">注册时间</th>
            <th field="u_update_time" width="50">更新时间</th>
        </tr>
        </thead>
    </table>
    <div id="toolbar">
        <div style="margin-top:10px;margin-bottom:10px" >
            <span style="margin-right:15px;margin-left:15px;">用户名</span><input class="easyui-textbox"  style="width:200px;margin-left:15px">
            <span style="margin-right:15px;margin-left:15px;">手机号</span><input class="easyui-textbox"  style="width:200px;margin-left:15px">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search"  style="margin-left:15px" onclick="newUser()">查询</a>
        </div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">新增</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">删除</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
         closed="true" buttons="#dlg-buttons">
        <div class="ftitle">用户信息</div>
        <form id="fm" method="post" novalidate>
            <div class="fitem">
                <label>用户ID:</label>
                <input name="u_id" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>用户名:</label>
                <input name="u_name" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>电话:</label>
                <input name="u_phone" class="easyui-textbox">
            </div>
            <div class="fitem">
                <label>邮箱:</label>
                <input name="u_email" class="easyui-textbox" validType="email">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()"
           style="width:90px">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel"
           onclick="javascript:$('#dlg').dialog('close')" style="width:90px">取消</a>
    </div>
    <script type="text/javascript">
        var server_url;
        function newUser() {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', '新增');
            $('#fm').form('clear');
            server_url = 'add_user';
        }
        function editUser() {
            var row = $('#dg').datagrid('getSelected');
            if (row) {
                $('#dlg').dialog('open').dialog('center').dialog('setTitle', '编辑');
                $('#fm').form('load', row);
                server_url = 'modify_user';
            }
        }
        function saveUser() {
            $('#fm').form('submit', {
                url: server_url,
                onSubmit: function () {
                    return $(this).form('validate');
                },
                success: function (result) {
                    var result = eval('(' + result + ')');
                    if(result.error_id == 1){
                        $.messager.alert('恭喜!','保存成功');
                    } else {
                        $.messager.alert('抱歉',result.error_desc);
                    }

                    $('#dlg').dialog('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload the user data
                },
                fail: function () {
                    alert('error');
                }
            });
        }
        function destroyUser() {
            var rows = $('#dg').datagrid('getSelections');

            if(rows.length > 0){
                var u_ids='';

                for(u_info in rows){
                    u_ids += rows[u_info].u_id+',';
                }

                $.messager.confirm('删除', '确认删除该用户吗?', function (r) {
                    if (r) {
                        $.post('del_user', {u_ids:u_ids}, function (result) {
                            if (result.error_id) {
                                $.messager.alert('恭喜!','操作成功');
                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.alert('抱歉','操作失败!');
                            }
                        }, 'json');
                    }
                });
            }

        }
    </script>
    <style type="text/css">
        #fm {
            margin: 0;
            padding: 10px 30px;
        }

        .ftitle {
            font-size: 14px;
            font-weight: bold;
            padding: 5px 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .fitem {
            margin-bottom: 5px;
        }

        .fitem label {
            display: inline-block;
            width: 80px;
        }

        .fitem input {
            width: 160px;
        }
    </style>
    </body>
@stop