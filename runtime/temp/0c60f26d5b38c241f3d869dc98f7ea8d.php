<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"C:\wamp64\www\public/../application/admin\view\database\database.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
            <blockquote class="layui-elem-quote layui-elem-quote-blue">
               数据库中共有 <span class="count" style="color: #177ce3;font-weight: bold;"></span> 张表，共计 <span class="size" style="color: #177ce3;font-weight: bold;"></span>
                <a href="javascript:void(0)" tipsmsg="备份" id="backUp" class="layui-btn layui-btns layui-btn-blue onmousemovebtns"><i class="fa fa-copy" aria-hidden="true"></i>&nbsp;备份</a>
                <a href="javascript:void(0)" tipsmsg="优化" id="optimize" class="layui-btn layui-btns layui-btn-green onmousemovebtns"><i class="fa fa-tree" aria-hidden="true"></i>&nbsp;优化</a>
                <a href="javascript:void(0)" tipsmsg="修复"  id="repair" class="layui-btn layui-btns layui-btn-red onmousemovebtns"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;修复</a>
            </blockquote>
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
<script type="text/html" id="statu">
    <input type="checkbox" name="statu" lay-skin="switch" lay-text="可用|禁止" value="{{d.id}}" lay-filter="statu" {{ d.statu == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="action">
    <a lay-event="backUp" tipsmsg="备份" class="layuimsg">
        <button class="layui-btn layui-btns layui-btn-blue layui-btn-xs">
            <i class="fa fa-copy" aria-hidden="true"></i>
        </button>
    </a> 
    <a lay-event="optimize" tipsmsg="优化" class="layuimsg">
        <button class="layui-btn layui-btns layui-btn-green layui-btn-xs">
            <i class="fa fa-tree" aria-hidden="true"></i>
        </button>
    </a>
    <a lay-event="repair" tipsmsg="修复" class="layuimsg">
        <button class="layui-btn layui-btns layui-btn-red layui-btn-xs">
            <i class="fa fa-wrench" aria-hidden="true"></i>
        </button>
    </a>
</script>
<script>
    layui.use(['table','form','element','layer'], function() {
        var table = layui.table,form = layui.form,element = layui.element,layer = layui.layer,$ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("database"); ?>',
            method: 'post',
            cols: [[
                {checkbox:true, align: 'center', width: 80},
                {field: 'Name', title: '数据库表', width: 200},
                {field: 'Rows', title: '记录条数', width: 130,sort: true,align:'center'},
                {field: 'size', title: '占用空间', width: 150,templet:'#size',sort: true,align:'center'},
                {field: 'Engine', title: '类型', width: 110},
                {field: 'Collation', title: '编码', width: 140,align:'center'},
                {field: 'Create_time', title: '创建时间', width: 180,sort: true,align:'center'},
                {field: 'Comment', title: '说明', width: 180},
                {title: '操作',width: 130,align: 'center', toolbar: '#action',fixed: 'right'},
            ]],
            done:function(res){
                onmousemoves();
                $('.count').html(res.tableNum);
                $('.size').html(res.total);
            }
        });

        //复选框选中的个数
        table.on('checkbox(list)', function (obj) {
            var checkStatus = table.checkStatus('list');
            var data = checkStatus.data;
            layer.msg('选中了：'+ data.length + ' 个');
        });
        
        //备份
        $('#backUp').click(function(){
            var obj = $(this);
            var checkStatus = table.checkStatus('list'); //test即为参数id设定的值
            var a = [];
            $(checkStatus.data).each(function(i,o){
                a.push(o.Name);
            });
            if (a == ""){
                layer.msg("请选择内容进行备份");
                return false;
            }
            obj.addClass('layui-btn-disabled');
            obj.html('备份进行中...');
            $.post("<?php echo url('backup'); ?>",{tables:a},function(data){
                if(data.code==1){
                    layer.msg(data.msg,function(){
                        tableIn.reload();
                    });
                }else if(data.code==0){
                    layer.msg(data.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
                obj.removeClass('layui-btn-disabled');
                obj.html('备份');
            });
        });
        
        //优化
        $('#optimize').click(function(){
            var obj = $(this);
            var checkStatus = table.checkStatus('list'); //test即为参数id设定的值
            var a = [];
            $(checkStatus.data).each(function(i,o){
                a.push(o.Name);
            });
            if (a == ""){
                layer.msg("请选择内容进行优化");
                return false;
            }
            obj.addClass('layui-btn-disabled');
            obj.html('优化进行中...');
            $.post("<?php echo url('optimize'); ?>",{tables:a},function(data){
                if(data.code==1){
                    layer.msg(data.msg,function(){
                        tableIn.reload();
                    });
                }else if(data.code==0){
                    layer.msg(data.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
                obj.removeClass('layui-btn-disabled');
                obj.html('优化');
            });
        });
        
        //修复
        $('#repair').click(function(){
            var obj = $(this);
            var checkStatus = table.checkStatus('list'); //test即为参数id设定的值
            var a = [];
            $(checkStatus.data).each(function(i,o){
                a.push(o.Name);
            });
            if (a == ""){
                layer.msg("请选择内容进行修复");
                return false;
            }
            obj.addClass('layui-btn-disabled');
            obj.html('修复进行中...');
            $.post("<?php echo url('repair'); ?>",{tables:a},function(data){
                if(data.code==1){
                    layer.msg(data.msg,function(){
                        tableIn.reload();
                    });
                }else if(data.code==0){
                    layer.msg(data.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
                obj.removeClass('layui-btn-disabled');
                obj.html('修复');
            });
        })

        table.on('tool(list)', function(obj) {
            var data = obj.data;
            var Name = [data.Name];
            if (obj.event === 'backUp') {
                $.post("<?php echo url('backup'); ?>",{tables:Name},function(data){
                    if(data.code==1){
                        layer.msg(data.msg,function(){
                            tableIn.reload();
                        });
                    }else if(data.code==0){
                        layer.msg(data.msg);
                    }else{
                        layer.msg('你无操作权限！');
                    }
                });
            }else if(obj.event === 'optimize'){
                $.post("<?php echo url('optimize'); ?>",{tables:Name},function(data){
                    if(data.code==1){
                        layer.msg(data.msg,function(){
                            tableIn.reload();
                        });
                    }else if(data.code==0){
                        layer.msg(data.msg);
                    }else{
                        layer.msg('你无操作权限！');
                    }
                }); 
            }else{
                $.post("<?php echo url('repair'); ?>",{tables:Name},function(data){
                    if(data.code==1){
                        layer.msg(data.msg,function(){
                            tableIn.reload();
                        });
                    }else if(data.code==0){
                        layer.msg(data.msg);
                    }else{
                        layer.msg('你无操作权限！');
                    }
               }); 
            }
        });
    });
</script>
