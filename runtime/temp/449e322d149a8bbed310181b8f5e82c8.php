<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"C:\wamp64\www\public/../application/admin\view\auth\adminadd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
                      <label class="layui-form-label">所属用户组</label>
                      <div class="layui-input-4">
                          <select name="group_id" lay-verify="required">
                            <option value="">请选择用户组</option>
                            <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo $vo['group_id']; ?>"><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">用户名</label>
                      <div class="layui-input-4">
                        <input type="text" name="username" autocomplete="off" placeholder="请输入用户名" class="layui-input" lay-verify="required">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">密码</label>
                      <div class="layui-input-4">
                        <input type="password" name="password" autocomplete="off" placeholder="请输入密码" class="layui-input" lay-verify="required">
                      </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">头像</label>
                        <input type="hidden" name="avatar" id="avatar">
                        <div class="layui-input-block">
                            <div class="layui-upload">
                                <button type="button" class="layui-btn layui-btns layui-btn-blue" id="adBtn"><i class="layui-icon" style="color: #fff">&#xe67c;</i>点击上传</button>
                                <div class="layui-upload-list">
                                    <img class="layui-upload-img" id="adPic" style="border-radius: 50%;">
                                    <p id="demoText"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="display: none;" id="jin">
                      <label class="layui-form-label"></label>
                      <div class="layui-input-4" style="width:140px;">
                          <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="progressBar">
                              <div class="layui-progress-bar layui-btn-blue" lay-percent="0%"></div>
                          </div>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">邮箱</label>
                      <div class="layui-input-4">
                        <input type="text" name="email" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">手机号</label>
                      <div class="layui-input-4">
                        <input type="text" name="tel" autocomplete="off" placeholder="请输入手机号" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">状态</label>
                      <div class="layui-input-block">
                        <input type="radio" name="is_open" value="1" title="启用" lay-verify="sex" checked>
                        <input type="radio" name="is_open" value="0" lay-verify="sex" title="禁止">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <div class="layui-input-block">
                        <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="add">添加</button>
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
var url = '<?php echo url("adminadd"); ?>';
layui.use(['form','layer','upload','element'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,upload = layui.upload
    ,element = layui.element 
    ,$ = layui.jquery;

    //监听提交
    form.on('submit(add)', function(data){
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
    //普通图片上传
    var uploadInst = upload.render({
          elem: '#adBtn'
          ,url: '<?php echo url("Upfiles/upimages"); ?>'
          ,before: function(obj){
              //预读本地文件示例，不支持ie8
              this.data={files:'admin'};//关键代码
          }
          ,progress: function(e , percent) {
              $("#jin").show();
              element.progress('progressBar',percent  + '%');
          }
          ,done: function(res){
              if(res.code>0){
                  $('#adPic').show();
                  $('#adPic').attr('src', '/public'+res.src);
                  $("#adPic").css({"width":80+"px","height":80+"px"});
                  $('#avatar').val(res.src);
              }else{
                  //如果上传失败
                  $("#jin").hide();
                  layer.msg('上传失败');
                  return false;
              }
          }
          ,error: function(){
              //演示失败状态，并实现重传
              $("#jin").hide();
              layer.msg('上传失败');
              return false;
          }
    });
});
</script>
