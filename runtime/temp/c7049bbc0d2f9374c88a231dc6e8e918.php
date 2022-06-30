<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"C:\wamp64\www\public/../application/admin\view\trill\commentedit.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
 
<div class="fadeInUp animated headalert" style="padding-right: 20px"><br>
    <div class="layui-anim layui-anim-up">
        <form class="layui-form">
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
            <div class="layui-container">
                <div class="layui-row">
                    <div class="layui-form-item">
                      <label class="layui-form-label">评论内容</label>
                      <div class="layui-input-4">
                          <!-- 加载编辑器的容器 -->
                          <textarea name="content"  placeholder="请输入评论内容" class="layui-textarea"><?php echo $info['content']; ?></textarea>
                          <!--<script id="container" name="content" type="text/plain"><?php echo $info['content']; ?>
                          </script>-->
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <div class="layui-input-block">
                        <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="edit">编辑</button>
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

<!--<script type="text/javascript" src="/public/static/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/public/static/ueditor/ueditor.all.js"></script>
<script type="text/javascript" src="/public/static/ueditor/ueditor.parse.js"></script>-->
<script type="text/javascript">
/*window.onload=function(){
    UE.getEditor('container',{
        toolbars: [
            [
                'fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript',
                'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor',
                'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc',
                'date','time','insertcode','fontfamily',
            ]
        ],
        initialFrameHeight:350,
        elementPathEnabled : false,
        wordCount: false ,
        allowDivTransToP:true,
    });
}*/
var url = '<?php echo url("commentedit"); ?>';
layui.use(['form','layer'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,$ = layui.jquery;

    form.on('submit(edit)', function(data){
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
