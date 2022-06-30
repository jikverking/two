<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"C:\wamp64\www\public/../application/admin\view\login\index.html";i:1558175186;}*/ ?>
<!DOCTYPE html>
<html lang="zh_cn">
<head> 
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>登录</title>
    <link rel="stylesheet" href="/public/static/common/layui/css/layui.css">
    <link rel="stylesheet" href="/public/static/admin/css/logins.css" />
    <link rel="stylesheet" href="/public/static/common/font/css/font-awesome.css" />
    <link rel="icon" href="/public/static/admin/images/favicon.ico">
</head>
<body class="beg-login-bg">
<div class="container login">
    <div class="content">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <div class="main-title">
                <div class="beg-login-box">
                    <header>
                        <h1>后台登录</h1>
                    </header>
                    <div class="beg-login-main">
                        <form class="layui-form layui-form-pane" method="post">
                            <div class="layui-form-item">
                                <label class="beg-login-icon fs1">
                                    <i class="layui-icon">&#xe66f;</i>
                                </label>
                                <input type="text" name="username" placeholder="请输入登录名" class="layui-input" value="<?php echo $username; ?>">
                            </div>
                            <div class="layui-form-item">
                                <label class="beg-login-icon fs1">
                                    <i class="layui-icon">&#xe673;</i> 
                                </label>
                                <input type="password"  name="password" placeholder="请输入密码" class="layui-input" value="<?php echo $password; ?>">
                            </div>
                            <?php if($config['code'] == 'open'): ?>
                            <div class="layui-form-item">
                                <label class="beg-login-icon fs1">
                                    <i class="layui-icon">&#xe679;</i>  
                                </label>
                                <input type="text" name="captcha" id="captcha" placeholder="验证码" autocomplete="off" class="layui-input" style="text-indent: 27px;">
                                <div class="captcha" style="border: none;">
                                    <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()"  style="height: 49px"/>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="layui-form-item" style="float: left;">
                                <input type="checkbox"  name="remember" value="1" lay-skin="primary" title="记住密码" <?php if($remb == 1): ?>checked<?php endif; ?> checked>
                            </div>
                            <div class="layui-form-item" style="text-shadow:2px 2px 6px rgba(0,0,0,0.4);color:red !important;">
                                <button type="submit" class="layui-btn btn-submit btn-blog login-button" lay-submit lay-filter="login">登录&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/public/static/common/layui/layui.js"></script>
<script src="/public/static/admin/js/rAF.js"></script>
<script src="/public/static/admin/js/logins.js"></script>
<script>
    layui.use(['form','layer'],function(){
        var form = layui.form,layer = layui.layer,$ = layui.jquery;
        //监听提交
        form.on('submit(login)', function(data){
           /* loading =layer.load(1, {shade: [0.1,'#fff'] });*///0.1透明度的白色背景
            $.post('<?php echo url("index"); ?>',data.field,function(res){
/*                layer.close(loading);*/
                if(res.code == 1){
                    layer.msg(res.msg);
                    location.href = res.url;
                  /*  layer.msg(res.msg, {icon: 1, time: 1000}, function(){
                        location.href = res.url;
                    });*/
                }else{
                    $('#captcha').val('');
                    layer.msg(res.msg);
                    $('.captcha img').attr('src','<?php echo captcha_src(); ?>?id='+Math.random());
                }
            },'json');
            return false;
        });
    });
</script>
</body>
</html>