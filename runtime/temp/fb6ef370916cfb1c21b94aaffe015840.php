<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"C:\wamp64\www\public/../application/admin\view\auth\groupaccess.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
 
<style type="text/css">
    ul.ztree li span.button.switch{margin-right:5px}
    ul.ztree>li{background: #dae6f0;padding: 8px;}
    ul.ztree>li ul li{background: #eef5fa;margin-top: 8px;padding: 5px;}
    ul.ztree>li ul li ul li{background: #f6fbff;padding: 5px;}
    ul.ztree>li ul li ul li ul li{background: #fff;padding: 5px;}
    ul.ztree ul ul ul li{display:inline-block;}
    ul.ztree>ul li>ul>li{padding:5px}
    ul.ztree>ul li>ul{margin-top:12px}
    ul.ztree>ul li{padding:15px;padding-right:25px}
    ul.ztree>ul li{white-space:normal!important;background: #01AAED}
    ul.ztree li{white-space:inherit;}
    ul.ztree>li>a>span{font-size:15px;font-weight:700}
</style>
<link rel="stylesheet" href="/public/static/admin/zTree/css/zTreeStyle.css" type="text/css">
<div class="layui-anim layui-anim-upbit headalert" style="margin-top: 5px;">
    <div class="layui-field-box">
        <form class="layui-form layui-form-pane">
            <ul id="treeDemo" class="ztree"></ul>
            <div class="layui-form-item text-center" align="center" style="margin-top: 20px;">
                <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="submit">提交</button>
                <button class="layui-btn layui-btns layui-btn-red" type="button" onclick="window.history.back()"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script src="/public/static/common/layui/layui.js"></script>

<script type="text/javascript" src="/public/static/common/js/jquery.2.1.1.min.js"></script>
<script type="text/javascript" src="/public/static/admin/zTree/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/public/static/admin/zTree/js/jquery.ztree.excheck.min.js"></script>
<script type="text/javascript">
    var setting = {
        check:{enable: true},
        view: {showLine: false, showIcon: false, dblClickExpand: false},
        data: {
            simpleData: {enable: true, pIdKey:'pid', idKey:'id'},
            key:{name:'title'}
        }
    };
    var zNodes =<?php echo $data; ?>;
    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = { "Y":"ps", "N":"ps"};

    }
    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
    setCheck();
    layui.use(['form', 'layer'], function () {
        var form = layui.form, layer = layui.layer;
        form.on('submit(submit)', function () {
            loading =layer.load(1, {shade: [0.1,'#fff']});
            // 提交到方法 默认为本身
            var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),
                nodes=treeObj.getCheckedNodes(true),
                v="";
            for(var i=0;i<nodes.length;i++){
                v+=nodes[i].id + ",";
            }
            var id = "<?php echo input('id'); ?>";
            $.post("<?php echo url('groupSetaccess'); ?>", {'rules':v,'group_id':id}, function (res) {
                layer.close(loading);
                if (res.code > 0) {
                    layer.msg(res.msg);
                        setTimeout(function(){
                          window.parent.location.reload();//修改成功后刷新父界面
                    },  1000);
                } else {
                    layer.msg(res.msg);
                }
            });
        })
    });
</script>