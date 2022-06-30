<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"C:\wamp64\www\public/../application/admin\view\user\useradd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/public/static/common/layui/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/css/view.css"/>
    <link rel="stylesheet" href="/public/static/admin/css/admin.css">
    <link rel="stylesheet" href="/public/static/admin/css/styles.css">
    <link rel="stylesheet" href="/public/static/common/font/css/font-awesome.css">
    <title>管理后台</title>
</head>
<body class="headbody">
 
<div class="fadeInUp animated headalert"><br>
    <div class="layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-container">
                <div class="layui-row">
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户名</label>
                        <div class="layui-input-4">
                            <input type="text" name="username" autocomplete="off" placeholder="请输入用户名" class="layui-input">
                            <div class="layui-form-mid layui-word-aux">
                                <span style="color: red">*</span> 用户名格式为4到16位（字母，数字，下划线，减号）
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号</label>
                        <div class="layui-input-4">
                            <input type="text" name="phone" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">用户密码</label>
                        <div class="layui-input-4">
                            <input type="password" name="password" autocomplete="off" placeholder="请输入用户密码" class="layui-input">
                            <div class="layui-form-mid layui-word-aux">
                                <span style="color: red">*</span> 密码格式为6到16位（字母，数字，下划线，减号）
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">到期时间</label>
                        <div class="layui-input-4">
                            <input type="text" name="endtime" autocomplete="off"  class="layui-input" id="endtime">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="statu" value="1" title="启用" lay-verify="statu" checked>
                            <input type="radio" name="statu" value="0" lay-verify="statu" title="禁止">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="useradd">添加</button>
                            <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script src="/public/static/common/layui/layui.js"></script>

<script>
    var url = '<?php echo url("useradd"); ?>';
    layui.use(['form','layer','laydate'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate
            ,$ = layui.jquery;

        laydate.render({
            elem: '#endtime'
            ,theme: '#4476A7'
            ,value: '<?php echo date("Y-m-d",strtotime("+1 day")); ?>'
            ,min: 0
        });

        //监听提交
        form.on('submit(useradd)', function(data){
            var username = $.trim(data.field.username);
            if(!(/^[a-zA-Z0-9_-]{4,16}$/).test(username)){
                layer.msg("请输入正确的用户名格式");
                return false;
            };

            var phone = $.trim(data.field.phone);
            if(!(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/).test(phone)){
                layer.msg("请输入正确的手机号码格式");
                return false;
            };

            var password = $.trim(data.field.password);
            if(!(/^[a-zA-Z0-9_-]{6,16}$/).test(password)){
                layer.msg("请输入正确的密码格式");
                return false;
            };

            $.post(url,data.field,function(res){
                if(res.code == 1){
                    layer.msg(res.msg);
                    setTimeout(function(){
                        window.parent.location.reload();//修改成功后刷新父界面
                    }, 1000);
                }else{
                    layer.msg(res.msg);
                }
            },'json')
            return false;
        });
    });
</script>
