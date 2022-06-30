<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"C:\wamp64\www\public/../application/admin\view\auth\ruleadd.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
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
    <blockquote class="layui-elem-quote layui-elem-quote-blue" style="margin:20px;">
       <span>
            &nbsp;&nbsp;&nbsp;1、《控/方》：意思是 控制器/方法; 例如 Sys/sysList<br/>
            &nbsp;&nbsp;&nbsp;2、图标名称为左侧导航栏目的图标样式，具体可查看<a href="http://www.fontawesome.com.cn/" target="_blank" style="color:#177ce3"> Font Awesome </a>图标
        </span>
    </blockquote>
    <br>
    <div class="layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-container">
                <div class="layui-row">
                    <div class="layui-form-item">
                      <label class="layui-form-label">父级</label>
                      <div class="layui-input-4">
                           <select name="pid" lay-verify="required" lay-filter="pid" >
                               <?php if(input('get.pid')): if(input('get.pid') == 0): ?>
                               <option value="0" selected="selected">默认顶级</option>
                               <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                               <option value="<?php echo $vo['id']; ?>"><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></option>
                               <?php endforeach; endif; else: echo "" ;endif; else: ?>
                               <option value="0">默认顶级</option>
                               <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['id'] == input('get.pid')): ?>
                               <option value="<?php echo $vo['id']; ?>" selected="selected"><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></option>
                               <?php else: ?>
                               <option value="<?php echo $vo['id']; ?>"><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></option>
                               <?php endif; endforeach; endif; else: echo "" ;endif; endif; else: ?>
                               <option value="0">默认顶级</option>
                               <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                               <option value="<?php echo $vo['id']; ?>"><?php echo $vo['lefthtml']; ?><?php echo $vo['title']; ?></option>
                               <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </select>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">权限名称</label>
                      <div class="layui-input-4">
                        <input type="text" name="title" lay-verify="required" placeholder="请输入权限名称" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">控制器/方法</label>
                      <div class="layui-input-4">
                          <input type="text" name="href" lay-verify="required" placeholder="请输入控制器/方法" class="layui-input">
                          <div class="layui-form-mid layui-word-aux">
                              <span style="color: red">*</span> 首字母大写，允许2-80字节，允许字母数字
                          </div>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">图标</label>
                      <div class="layui-input-4">
                        <input type="text" name="icon" placeholder="请输入图标名称" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单状态</label>
                        <div class="layui-input-inline">
                            <input type="radio" name="menustatus" lay-filter="menustatus" checked value="1" title="开启">
                            <input type="radio" name="menustatus" lay-filter="menustatus" value="0" title="关闭">
                        </div>
                    </div>
                    <div class="layui-form-item">
                      <label class="layui-form-label">排序</label>
                      <div class="layui-input-inline">
                        <input type="text" name="sort" value="50" placeholder="请输入排序编号" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <div class="layui-input-block">
                        <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="ruleadd">添加</button>
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
var url = '<?php echo url("ruleadd"); ?>';
layui.use(['form','layer','element'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,element = layui.element
    ,$ = layui.jquery;
    //监听提交
    form.on('submit(ruleadd)', function(data){
        var href = data.field.href;
        if(!(/^[A-Z][a-zA-Z0-9]{1,79}$/).test(href)){
            layer.msg("控制器/方法格式错误");
            return false;
        };
        $.post(url,data.field,function(res){
            if(res.code == 1){
                layer.msg(res.msg);
                setTimeout(function(){
                    window.parent.location.reload();
                }, 1000);
            }else{
                layer.msg(res.msg);
            }
        },'json')
        return false;
    }); 
});
</script>
</body>
</html>