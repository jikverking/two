<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"C:\wamp64\www\public/../application/admin\view\config\accesslist.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654616318;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
            <blockquote class="layui-elem-quote layui-elem-quote-red" id="boxmain">
                <span id="hand" style="cursor: pointer;">
                    <i class="fa fa-hand-pointer-o" aria-hidden="true" style="font-size: 18px;color: #FF6347"></i>
                    <span style="color:#4476A7">操作提示</span>
                </span>
                <br>
                <span style="font-size: 12px;" id="cons">
                    <span style="color: #FF6347">♠</span>
                    如果用户左侧栏要显示第三层，第二层控制器/方法内容: Show
                </span>
            </blockquote>
            <blockquote class="layui-elem-quote layui-elem-quote-blue">
                <button  tipsmsg="添加" class="layui-btn layui-btns layui-btn-blue onmousemovebtns" onclick="x_admin_show('添加权限','<?php echo url('accessadd'); ?>','610px','610px','95%','95%')"><i class="layui-icon"></i>添加</button>
                <button tipsmsg="展开或折叠全部" class="layui-btn layui-btns layui-btn-green onmousemovebtns" onclick="openAll();"><i class="layui-icon">&#xe857;</i>展开或折叠全部</button>
            </blockquote>
            <table class="layui-hide" id="tableId" lay-filter="tableId"></table>
        </div>
    </div>
</div>
<script type="text/javascript" src="/public/static/common/js/jquery.2.1.1.min.js"></script>
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
<script type="text/javascript" src="/public/static/common/js/common.js"></script>
<script type="text/html" id="auth">
    {{# if(d.authopen == 0){ }}
       <input type="checkbox" name="authopen" lay-skin="switch" lay-text="是|否" value="{{d.id}}" lay-filter="authopen" checked>
    {{# }else{  }}
       <input type="checkbox" name="authopen" lay-skin="switch" lay-text="是|否" value="{{d.id}}" lay-filter="authopen">
    {{# } }}
</script>
<script type="text/html" id="levels">
    {{# for (var i=0;i<d.levels;i++){ }}
    <i class="fa fa-star" aria-hidden="true" style="color:#4476A7"></i>
    {{# } }}
</script>
<script type="text/html" id="status">
    <input type="checkbox" name="menustatus" value="{{d.id}}" lay-skin="switch" lay-text="显示|隐藏" lay-filter="menustatus" {{ d.menustatus == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="order">
    <input name="{{d.id}}" data-id="{{d.id}}" class="list_order layui-input" value=" {{d.sort}}" size="10" style="width: 45px;height: 25px;" />
</script>
<script type="text/html" id="icon">
    <i class="fa fa-{{d.icon}}" aria-hidden="true">
</script>
<script type="text/html" id="action">
    <a tipsmsg="添加子菜单" class="layuimsg" onclick="x_admin_show('添加子菜单','<?php echo url('accessadd'); ?>?pid={{d.id}}','610px','610px','95%','95%')">
        <button class="layui-btn layui-btns layui-btn-blue layui-btn-xs">
            <i class="layui-icon"></i>
        </button>
    </a>
    <a tipsmsg="编辑权限" class="layuimsg" onclick="x_admin_show('编辑权限','<?php echo url('accessedit'); ?>?id={{d.id}}','610px','610px','95%','95%')">
    <button class="layui-btn layui-btns layui-btn-green layui-btn-xs">
      <i class="layui-icon">&#xe642;</i>
    </button>
    </a>
    <a tipsmsg="删除" class="layuimsg" lay-event="del">
    <button class="layui-btn layui-btns layui-btn-red layui-btn-xs">
      <i class="layui-icon">&#xe640;</i>
    </button>
    </a>
</script>
<script>
var editObj=null,ptable=null,treeGrid=null,tableId='tableId',layer=null;
    layui.config({
        base: '/public/static/common/layui/extend/'
    }).extend({
        treeGrid:'treeGrid'
    }).use(['jquery','treeGrid','layer','form','element'], function(){
        var $=layui.jquery;
        treeGrid = layui.treeGrid;
        layer=layui.layer;
        element = layui.element;
        form = layui.form;
        ptable=treeGrid.render({
            id:tableId
            ,elem: '#'+tableId
            ,idField:'id'
            ,url:'<?php echo url("accesslist"); ?>'
            ,text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'}
            ,cellMinWidth: 100
            ,treeId:'id'//树形id字段名称
            ,treeUpId:'pid'//树形父id字段名称
            ,treeShowName:'title'//以树形式显示的字段
            ,height:'full-140'
            ,isFilter:false
            ,iconOpen:true//是否显示图标【默认显示】
            ,isOpenDefault:false//节点默认是展开还是折叠【默认展开】
            ,cols: [[
                {field: 'id', title: '编号', width: 100,sort:true,align:'center'},
                {field: 'icon', align: 'center',title: '图标', width: 80,templet: '#icon'},
                {field: 'title', title: '权限名称', width: 200},
                {field: 'href', title: '控制器/方法', width: 200},
                {field: 'levels', title: '层级', width: 100,toolbar: '#levels'},
                {field: 'authopen',align: 'center', title: '是否验证权限', width: 120,toolbar: '#auth'},
                {field: 'menustatus',align: 'center',title: '菜单状态', width: 120,toolbar: '#status'},
                {field: 'sort',align: 'center', title: '排序', width: 100, templet: '#order',sort:true},
                {title:'操作',width: 140,align: 'center', toolbar: '#action',fixed: 'right'}
            ]]
            ,page:false
            ,done:function(msg){
                onmousemoves();
               /* console.log(msg.data);*/
            }
        });

        $('#hand').click(function(){
            if($('#cons').css('display')=='none'){
                $('#cons').show(500);
            }else{
                $('#cons').hide(500);
            }

        });

        //修改验证权限状态
        form.on('switch(authopen)', function(obj){
            var urls = "<?php echo url('authopen'); ?>";
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var authopen = obj.elem.checked===true?0:1;
            $.post(urls,{'id':id,'authopen':authopen},function(msg) {
                layer.close(loading);
                if(msg.code == 1){
                    layer.msg(msg.msg);
                    window.location.reload();
                }else if(msg.code == 0) {
                    layer.msg(msg.msg);
                    window.location.reload();
                }else{
                    layer.msg('你无操作权限！');
                    window.location.reload();
                }
            },'json');
        });

        //修改菜单状态
        form.on('switch(menustatus)', function(obj){
            var urls = "<?php echo url('menustatus'); ?>";
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var menustatus = obj.elem.checked===true?1:0;
            $.post(urls,{'id':id,'menustatus':menustatus},function(msg) {
                layer.close(loading);
                if(msg.code == 1){
                    layer.msg(msg.msg);
                    window.location.reload();
                }else if(msg.code == 0) {
                    layer.msg(msg.msg);
                    window.location.reload();
                }else{
                    layer.msg('你无操作权限！');
                    window.location.reload();
                }
            },'json');
        });
       
        //单条信息删除
        treeGrid.on('tool('+tableId+')', function(obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除该分组吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('accessdel'); ?>",{id:data.id},function(res){
                        layer.close(loading);
                        if(res.code===1){
                            layer.msg(res.msg);
                            obj.del();
                        }else if(res.code === 0) {
                            layer.msg(res.msg);
                            window.location.reload();
                        }else{
                            layer.msg('你无操作权限！');
                            window.location.reload();
                        }
                    },'json');
                    layer.close(index);
                });
            }
        });

        $('body').on('blur','.list_order',function() {
           var id = $(this).attr('data-id');
           var sort = $(this).val();
           $.post('<?php echo url("rulesort"); ?>',{id:id,sort:sort},function(res){
                if(res.code==1){
                    layer.msg(res.msg);
                    window.location.reload();
                }else if(res.code === 0) {
                    layer.msg(res.msg);
                    window.location.reload();
                }else{
                    layer.msg('你无操作权限！');
                    window.location.reload();
                }
           })
        })
    });

function openAll() {
    var treedata=treeGrid.getDataTreeList(tableId);
    treeGrid.treeOpenAll(tableId,!treedata[0][treeGrid.config.cols.isOpen]);
}
</script>