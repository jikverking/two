<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"C:\wamp64\www\public/../application/admin\view\device\groupadd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
                        <label class="layui-form-label">分组名称</label>
                        <div class="layui-input-4">
                            <input type="text" name="name" autocomplete="off" placeholder="请输入分组名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分组备注</label>
                        <div class="layui-input-4">
                            <textarea name="comment"  placeholder="请输入分组备注" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="groupadd">添加</button>
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
    var url = '<?php echo url("groupadd"); ?>';
    layui.use(['form','layer'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,$ = layui.jquery;
        //监听提交
        form.on('submit(groupadd)', function(data){
            var name = data.field.name;
            var comment = data.field.comment;
            if(name == ""){
                layer.msg("分组名称不能为空");
                return false;
            }

            if(comment == ""){
                layer.msg("分组备注不能为空");
                return false;
            }
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
