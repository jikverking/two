<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"C:\wamp64\www\public/../application/admin\view\device\deviceadd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
                        <label class="layui-form-label">设备UID</label>
                        <div class="layui-input-4">
                            <input type="text" name="uid" autocomplete="off" placeholder="请输入设备UID" class="layui-input" id="uid">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">设备特征码</label>
                        <div class="layui-input-4">
                            <input type="text" name="imei" autocomplete="off" placeholder="请输入设备特征码" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="diviceadd">添加</button>
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
    var url = '<?php echo url("deviceadd"); ?>';
    layui.use(['form','layer'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,$ = layui.jquery;
        //监听提交
        form.on('submit(diviceadd)', function(data){
            var uid = data.field.uid;
            var imei = data.field.imei;
            if(uid == ""){
                layer.msg("设备UID不能为空");
                return false;
            }
            if(!(/^[0-9]*$/).test(uid)){
                layer.msg("设备UID请输入数字");
                return false;
            };

            if(imei == ""){
                layer.msg("设备特征码不能为空");
                return false;
            }
            if(!(/^[0-9]*$/).test(imei)){
                layer.msg("设备特征码请输入数字");
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
