<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"C:\wamp64\www\public/../application/admin\view\database\restore.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
    <link rel="icon" href="/public/static/admin/images/favicon.ico">
    <title>管理后台</title>
</head>
<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header custom-header">
            <ul class="layui-nav layui-layout-left lefts">
                <li class="layui-nav-item onmousemovebtns" lay-unselect id="slide-sidebar" tipsmsg="伸缩">
                    <a href="javascript:;" class="icon-font"><i class="ai ai-menufold icons"></i></a>
                </li>
                <li class="layui-nav-item onmousemovebtns" lay-unselect tipsmsg="回到首页">
                     <a href="<?php echo url('index/index'); ?>"><i class="fa fa-home icons" aria-hidden="true" style="font-size: 18px;"></i></a>
                </li>
                <li class="layui-nav-item admin-side-full onmousemovebtns" lay-unselect tipsmsg="全屏">
                     <a href="javascript:;"><i class="fa fa-arrows icons" aria-hidden="true"></i></a>
                </li>
                <li class="layui-nav-item onmousemovebtns" lay-unselect id="cache" tipsmsg="清除缓存">
                     <a href="javascript:location.replace(location.href);"><i class="fa fa-eraser icons" aria-hidden="true"></i></a>
                </li>
                <li class="layui-nav-item onmousemovebtns" lay-unselect tipsmsg="刷新">
                     <a href="javascript:location.replace(location.href);"><i class="fa fa-history falocation icons" aria-hidden="true"></i></a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
              <li class="layui-nav-item" lay-unselect="">
                <a href="javascript:;">
                    <?php if($admininfo['avatar'] != null): ?>
                        <img class="headimg" src="/public<?php echo $admininfo['avatar']; ?>">
                    <?php else: ?>
                        <img class="headimg"  src="/public/static/admin/images/head.jpg"/>
                    <?php endif; ?>
                &nbsp;<?php echo session('username'); ?>&nbsp;&nbsp;
                </a>
                <dl class="layui-nav-child layui-nav-childs">
                  <dd><a onclick="x_admin_show('个人资料','<?php echo url('auth/adminedit'); ?>?id=<?php echo session('adminid'); ?>','500px','480px','95%','95%')"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;个人资料</a></dd>
                  <dd><a onclick="x_admin_show('修改密码','<?php echo url('auth/editpass'); ?>?id=<?php echo session('adminid'); ?>','400px','240px','95%','65%')"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;修改密码</a></dd>
                  <dd><a href="<?php echo url('login/loginout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;退出</a></dd>
                </dl>
              </li>
            </ul>
        </div>
        <div class="layui-side custom-admin">
            <div class="layui-side-scroll">
                <div class="custom-logo">
                    <img src="/public/static/admin/images/logo.png" alt=""/>
                    <h1 style="letter-spacing: 2px;font-family:楷体;font-size: 21px;">后台管理</h1>
                   <!--  <h1>Admin Pro</h1> -->
                </div>
                <ul class="layui-nav layui-nav-tree"  id="Nav">
                    <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="layui-nav-item <?php if($urls == $vo['href']): ?>layui-nav-itemed<?php endif; ?>">
                        <a class="is" href="javascript:;">
                            <i class="fa fa-<?php echo $vo['icon']; ?>" aria-hidden="true" style="line-height: 50px !important;"></i>
                            <em><?php echo $vo['title']; ?></em>
                        </a>
                        <?php if(!(empty($vo['children']) || (($vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator ) && $vo['children']->isEmpty()))): ?>
                        <dl class="layui-nav-child">
                            <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>
                            <dd <?php if(substrs($vos['href']) == $url): ?>class="layui-this"<?php endif; ?>>
                               <a href="<?php echo $vos['href']; ?>"><i class="fa fa-<?php echo $vos['icon']; ?>" aria-hidden="true"></i><?php echo $vos['title']; ?></a>
                            </dd>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </dl>
                        <?php endif; ?>


                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>

            </div>
        </div>
        <div class="layui-body">
            <div class="layui-content">

<div class="layui-page-header headers">
    <div class="pagewrap">
        <span class="layui-breadcrumb">
          <a href="<?php echo url('index/index'); ?>">首页</a>
          <a href="javascript:;"><?php echo $authruleinfo['pid']; ?></a>
          <a><cite><?php echo $authruleinfo['id']; ?></cite></a>
        </span>
        <a href="javascript:location.replace(location.href);" style="float:right" class="layui-btn layui-btn-blue refreshs"><i class="fa fa-history falocation" aria-hidden="true"></i>
        </a>
    </div>
</div>
<div class="layui-row">
    <div class="layui-card">
        <div class="layui-card-body">
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>
        </div> 
    </div>  
    <br>
    <br>  
    <div class="layui-footer footer">
        <p>后台管理系统</p>
    </div>
    <div class="mobile-mask"></div>
    </div>
</body>
</html>
<!-- <ul class="layui-fixbar">
<li class="layui-icon layui-fixbar-top" lay-type="top" style="background-color: rgb(0, 150, 136); display: list-item;" ></li>
</ul> -->
<script type="text/javascript" src="/public/static/common/js/jquery.2.1.1.min.js"></script>
<script src="/public/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/public/static/common/js/common.js"></script>
<script>
	layui.config({
	  base: '/public/static/admin/js/' 
	}).use('home');	
</script>
<script>
    layui.use('layer',function(){
        var $ = layui.jquery, layer = layui.layer;
        $('#cache').click(function () {
            $.post('<?php echo url("index/clear"); ?>',function (data) {
                layer.msg(data.msg,function() {
                    window.location.reload();
                });
               
            },'json');
        });
    })
</script>
<!-- <script>
layui.use(['util', 'layer'], function(){
  var util = layui.util
  ,layer = layui.layer 
  //固定块
  util.fixbar({
    bar1: false
    ,bar2: false
    ,css: {right: 10, bottom: 10}
    ,bgcolor: '#393D49'
  });
  
});
</script> -->
<script type="text/html" id="action">
    <a tipsmsg="恢复" class="layuimsg" lay-event="recover">
    <button class="layui-btn layui-btns layui-btn-blue layui-btn-xs">
      <i class="layui-icon">&#xe669;</i>
    </button>
    </a>
    <a tipsmsg="下载" class="layuimsg" href="<?php echo url('downFile'); ?>?time={{d.time}}" >
    <button class="layui-btn layui-btns layui-btn-green layui-btn-xs greens">
      <i class="layui-icon">&#xe601;</i>
    </button>
    </a>
    <a tipsmsg="删除" class="layuimsg" lay-event="del">
    <button class="layui-btn layui-btn-xs layui-btns layui-btn-red">
      <i class="layui-icon">&#xe640;</i>
    </button>
    </a>
</script>
<script>
    layui.use(['table','form','element','layer'], function() {
        var table = layui.table,form = layui.form,element = layui.element,layer = layui.layer,$ = layui.jquery;
        table.render({
            elem: '#list'
            ,url: '<?php echo url("restore"); ?>'
            ,method:'post'
            ,cols: [[
                {field:'name', title: '文件名称', width:250}
                ,{field:'size', title: '文件大小', width:200,sort:true}
                ,{field:'addtime', title: '备份时间', width:170,sort:true,align:'center'}
                ,{width:130, align:'center', toolbar: '#action',title:'操作',fixed: 'right'}
            ]]
            ,done:function(msg){
                onmousemoves();
            }
        });
        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'recover') {
                layer.confirm('确认要导入数据吗？',{icon: 0,skin: 'layui-layer-lan',anim: 4}, function (index) {
                    loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('import'); ?>",{time:data.time},function(res){
                        layer.close(loading);
                        if(res.code==1){
                            layer.msg(res.msg);
                        }else if(res.code==0){
                            layer.msg(res.msg);
                        }else{
                            layer.msg('你无操作权限!');
                        }
                    });
                    layer.close(index);
                });
            }else if(obj.event === 'del'){
                layer.confirm('确认要删除该备份文件吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4}, function (index) {
                    loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post('<?php echo url("delSqlFiles"); ?>',{time: data.time}, function (res) {
                        layer.close(loading);
                        if (res.code == 1) {
                            layer.msg(res.msg);
                            obj.del();
                        }else if(res.code==0){
                            layer.msg(res.msg);
                        }else{
                            layer.msg('你无操作权限!');
                        }
                    });
                    layer.close(index);
                });
            }
        });
    });
</script>