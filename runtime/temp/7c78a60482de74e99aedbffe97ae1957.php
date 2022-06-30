<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"C:\wamp64\www\public/../application/admin\view\device\grouplist.html";i:1654615014;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654616318;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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

<style>
  /*  .tipsinfo{
        margin: 0px -10px 10px 0px;
    }*/
    .tipsinfo p:hover{
       color: #FF0000;
    }
</style>
<!--<ul class="layui-nav" style="background: none;" id="shows">
    <li class="layui-nav-item">
        <dl class="layui-nav-child">
            <dd><a href="javascript:;">修改信息</a></dd>
            <dd><a href="javascript:;">安全管理</a></dd>
            <dd><a href="javascript:;">退了</a></dd>
        </dl>
    </li>
</ul>-->
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
<div class="layui-row layui-rows">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="demoTable">
                <button  tipsmsg="删除" class="layui-btn layui-btns layui-btn-red onmousemovebtns" id="delAll"><i class="layui-icon">&#xe640;</i>删除</button>
            </div>
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
<script type="text/html" id="task_state">
    {{# if(d.task_state=='忙'){ }}
    <button class="layui-btn layui-btn-orange layui-btn-xs layui-btns">
        <i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;忙
    </button>
    {{# }else{  }}
    <button class="layui-btn layui-btn-green layui-btn-xs layui-btns">
        <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;&nbsp;闲
    </button>
    {{# } }}
</script>
<script type="text/html" id="topBtn">
    <button class="layui-btn layui-btn layui-btn-blue layui-btn-sm" onclick="x_admin_show('添加分组','<?php echo url('groupadd'); ?>','500px','320px','95%','75%')"><i class="layui-icon"></i>添加</button>
</script>
<!--<script type="text/html" id="action" >
  <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑分组','<?php echo url('groupedit'); ?>?id={{d.id}}&name={{d.name}}&comment={{d.comment}}','500px','320px','95%','75%')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a>
    <a lay-event="del" tipsmsg="删除" class="layuimsg">
    <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
      <i class="layui-icon">&#xe640;</i>
    </button>
    </a>
</script>-->
<script type="text/html" id="action" >
    <a  ids="{{d.id}}"
        tipsedit="x_admin_show('编辑分组','<?php echo url("groupedit"); ?>?id={{d.id}}&name={{d.name}}&comment={{d.comment}}','500px','320px','95%','75%')"
       tipsupgrades="x_admin_show('要升级的软件网络URL','<?php echo url("upgrades"); ?>?id={{d.id}}','400px','200px','95%','200px')"
    class="layuimsg">
    <button class="layui-btn layui-btn-black layui-btn-xs layui-btns">
        <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;<i class="layui-icon">&#xe625;</i>
    </button>
    </a>
</script>
<script>
    layui.use(['table','form','element'], function() {
        var table = layui.table,form = layui.form,element = layui.element, $ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("grouplist"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            page: true,
            cols: [[
           /*     {checkbox:true,width: 80},*/
                {field: 'id', title: 'ID', width: 120,align: 'center',sort:true},
                {field: 'name', title: '分组名称',width:150,align: 'center'},
                {field: 'tji', title: '组内设备数量',width:150,align: 'center',sort:true},
                {field: 'comment', title: '备注',width:200},
    /*            {field:'task_state',title: '空闲状态',width:120, align: 'center', toolbar: '#task_state'},*/
                {field: 'time', title: '添加时间',align: 'center',width:170,sort:true},
                {width: 120,title: '操作', align: 'center', toolbar: '#action'}
            ]],
            limit: 10, //每页默认显示的数量
            limits:[10,100,200,400,600,1000,2000],
            done:function(msgs){
                /*onmousemoves();*/
                onmousemove();
               /* console.log(msgs.data);*/
            }
        });

        $(document).on('click','.layui-table-cell',function(){
            // $("p").css({"background-color":"blue","font-size":"14px"});
            var x=$(this).offset(),
                left=x.left,
                top=x.top;
            var w=$(this).width(),
                h=$(this).height();
            $('.hoverDiv').css({
                "width":w,
                "left":left+"px",
                "top":top+h+'px',
                "display":'block',
                "background":'pink',
            }).slideDown();
        })

        function onmousemove(){
            var tipsinfo = null;
            $('td .layuimsg').click(function(){
                layer.close(tipsinfo);
                var infos = $('.layui-layer-tips').css('display');
                /*alert(infos)*/
                var tipsedit = $(this).attr('tipsedit');
                var tipsupgrades = $(this).attr('tipsupgrades');
                var ids = $(this).attr('ids');
                var msg = tipsedit;
                var msg = '<div class="tipsinfo">'
                    +
                    '<p onclick='+tipsedit+'> <i class="layui-icon">&#xe642;</i>&nbsp;&nbsp;编辑</p>'
                    +'<p id="del" ids='+ids+'><i class="layui-icon">&#xe640;</i>&nbsp;&nbsp;删除</p>'
                    +'<p ids='+ids+' id="restart"><i class="fa fa-circle-o-notch" aria-hidden="true" style="text-indent: 2px;"></i>&nbsp;&nbsp;设备重启</p>'
                    +'<p ids='+ids+' id="cleanemptys"><i class="fa fa-grav" aria-hidden="true" style="text-indent: 2px;"></i>&nbsp;&nbsp;任务清空</p>'
                    +'<p onclick='+tipsupgrades+'><i class="fa fa-sort-amount-asc" aria-hidden="true" style="text-indent: 2px;"></i>&nbsp;&nbsp;软件升级</p>'
                    +'<p><i class="fa fa-eye" aria-hidden="true" style="text-indent: 2px;"></i></i>&nbsp;&nbsp;查看设备</p>'
                    + '</div>';

                /* var msg = "<p "+tipsedit+">编辑</p>"*/
                if(infos=='block'){
                    layer.close(tipsinfo);
                }else{
                    tipsinfo = layer.tips(msg, this,{
                        tips: 3, //还可配置颜色
                        time: 60000000
                    });
                }
                $('#del').click(function(){
                    var ids = $(this).attr('ids');
                    alert(ids);
                })

                //设备重启
                $("#restart").click(function(){
                    var id = $(this).attr('ids');
                    var url = "<?php echo url('restarts'); ?>";
                    pushtask(id,url);
                })

                //任务清空
                $("#cleanemptys").click(function(){
                    var id = $(this).attr('ids');
                    var url = "<?php echo url('cleanemptys'); ?>";
                    pushtask(id,url);
                })

                function pushtask(id,url){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post(url, {id: id}, function (data) {
                        layer.close(loading);
                        if (data.code === 1) {
                            layer.msg(data.msg);
                            tableIn.reload();
                        }else if(data.code === 0) {
                            layer.msg(data.msg);
                        }else{
                            layer.msg('你无操作权限！');
                        }
                    },'json');
                }

            })
        }

        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除该信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('devicedel'); ?>",{id:data.id},function(res){
                        layer.close(loading);
                        if(res.code===1){
                            layer.msg(res.msg);
                            tableIn.reload();
                        }else if(res.code === 0) {
                            layer.msg(res.msg);
                        }else{
                            layer.msg('你无操作权限！');
                        }
                    },'json');
                    layer.close(index);
                });
            }
        });

        $('#delAll').click(function(){
            var checkStatus = table.checkStatus('list'); //test即为参数uid设定的值
            var id = [];
            $(checkStatus.data).each(function (i, o) {
                id.push(o.id);
            });
            if (id == ""){
                layer.msg("请选择内容进行删除");
                return false;
            }
            layer.confirm('确认要删除选中信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index) {
                layer.close(index);
                var loading = layer.load(1, {shade: [0.1, '#fff']});
                id = id.toString();
                $.post("<?php echo url('devicedel'); ?>", {id: id}, function (data) {
                    layer.close(loading);
                    if (data.code === 1) {
                        layer.msg(data.msg);
                        tableIn.reload();
                    }else if(data.code === 0) {
                        layer.msg(data.msg);
                    }else{
                        layer.msg('你无操作权限！');
                    }
                },'json');
            });
        })
    });
</script>
