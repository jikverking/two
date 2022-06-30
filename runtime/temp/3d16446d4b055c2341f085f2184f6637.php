<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"C:\wamp64\www\public/../application/admin\view\device\devicealladd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
 
<div class="fadeInUp animated headalert">
    <blockquote class="layui-elem-quote layui-elem-quote-red" style="margin:20px;">
       <span>
            &nbsp;&nbsp;&nbsp;1、上传的文件为“.txt”格式。<br/>
            &nbsp;&nbsp;&nbsp;2、文件内容一台设备一行，UID|特征码。<br/>
              <div class="layui-input-inline" style="margin-top: 10px;margin-left: 10px;">
                   <a href="<?php echo url('down'); ?>">
                       <button type="button" class="layui-btn layui-btns layui-btn-red" id="adBtn">
                           <i class="fa fa-cloud-download" aria-hidden="true"></i>
                           下载文件模板
                       </button>
                   </a>
              </div>
       </span>
    </blockquote>
    <div class="layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-container">
                <div class="layui-row" style="margin-left: -30px">
                    <div class="layui-form-item">
                        <label class="layui-form-label">文件上传</label>
                        <div class="layui-input-block">
                        <div class="layui-upload">
                            <div class="layui-upload-drag" id="test2">
                                <i class="layui-icon" style="color: #177ce3"></i>
                                <p>点击上传，或将文件拖拽到此处</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="display: none;" id="jin">
                        <label class="layui-form-label"></label>
                        <div class="layui-input-4" style="width:200px;">
                            <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="progressBar">
                                <div class="layui-progress-bar layui-btn-blue" lay-percent="0%"></div>
                            </div>
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
    var loading = "";
    layui.use(['form','layer','upload','element'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,upload = layui.upload
            ,element = layui.element
            ,$ = layui.jquery;
        //多文件列表示例
        var uploadInst = upload.render({
            elem: '#test2'
            ,url: '<?php echo url("devicealladd"); ?>'
            ,accept: 'file'
            ,exts: 'txt'
            ,progress: function(e , percent) {
                $("#jin").show();
                element.progress('progressBar',percent  + '%');
            }
            ,before: function(){
                this.data={files:'device'};//关键代码
                loading = layer.load(2, { //icon支持传入0-2
                    shade: [0.3, 'black'], //0.5透明度的灰色背景
                    content: '上传中...',
                    success: function (layero) {
                        layero.find('.layui-layer-content').css({
                            'padding-top': '39px',
                            'width': '60px'
                        });
                    }
                });
            }
            ,done: function(res){
                if(res.code == 1){
                    layer.close(loading);
                    layer.msg(res.msg);
                    setTimeout(function(){
                        window.parent.location.reload();//修改成功后刷新父界面
                    }, 1000);
                }else{
                    //如果上传失败
                    layer.close(loading);
                    $("#jin").hide();
                    layer.msg(res.msg);
                    return false;
                }
            }
            ,error: function(){
                layer.close(loading);
                layer.msg('上传失败');
                return false;
            }
        });
    });
</script>
