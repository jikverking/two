<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"C:\wamp64\www\public/../application/admin\view\device\devicelist.html";i:1654614894;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654620072;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
                    <h1 style="letter-spacing: 2px;font-family:楷体;font-size: 21px;">店面管理系统</h1>
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
<style type="text/css">
    .custom-logo h1 {
    display: inline;
    margin: 0 5px 0 1px;
    font-size: 18px;
    vertical-align: middle;
}
.custom-logo img {
    margin-left: 0px;
    height: 32px;
}
</style>
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
                <button  tipsmsg="批量添加" class="layui-btn layui-btn layui-btn-blue layui-btns onmousemovebtns" onclick="x_admin_show('批量添加设备','<?php echo url('devicealladd'); ?>','500px','400px','95%','75%')">
                    <i class="layui-icon"></i>批量添加
                </button>
                <button  tipsmsg="任务清空" class="layui-btn layui-btn layui-btn-violet layui-btns onmousemovebtns" id="emptys">
                    <i class="fa fa-grav" aria-hidden="true"></i>&nbsp;任务清空
                </button>
                <button  tipsmsg="软件升级" class="layui-btn layui-btn layui-btn-orange layui-btns onmousemovebtns" id="upgrade">
                    <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>&nbsp;软件升级
                </button>
                <button  tipsmsg="设备重启" class="layui-btn layui-btn layui-btn-black layui-btns onmousemovebtns" id="restart">
                    <i class="fa fa-circle-o-notch" aria-hidden="true"></i>&nbsp;设备重启
                </button>
                <button  tipsmsg="加入分组" class="layui-btn layui-btn layui-btn-green layui-btns onmousemovebtns" id="addgroups">
                    <i class="layui-icon"></i>加入分组
                </button>
                <button  tipsmsg="删除" class="layui-btn layui-btns layui-btn-red onmousemovebtns" id="delAll"><i class="layui-icon">&#xe640;</i>删除</button>
                <span class="layui-form layui-input-inline box">
                    <select id="infomsg">
                        <option value="UID" selected>UID</option>
                        <option value="IMEI">IMEI</option>
                        <option value="备注">备注</option>
                        <option value="品牌">品牌</option>
                        <option value="型号">型号</option>
                    </select>
                </span>
                <div class="layui-inline layui-inlines">
                    <input class="layui-input" name="key" id="key" placeholder="请输入查询内容">
                </div>
                <button class="layui-btn layui-btns layui-btn-blue" id="search" data-type="reload"><i class="layui-icon" style="color: #fff">&#xe615;</i>搜索</button>
            </div>
            <table class="layui-table" id="list" lay-filter="list"></table>
        </div>
    </div>
</div>
<div class="headalert" id="test" style="display: none;"><br>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">分组</label>
            <div class="layui-input-inline">
                <select name="group_id">
                    <option value="">请选择分组</option>
                    <?php if(is_array($group) || $group instanceof \think\Collection || $group instanceof \think\Paginator): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="addgroups">分组</button>
                <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>

<div class="headalert" id="upgrades" style="display: none;"><br>
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">URL地址</label>
            <div class="layui-input-inline">
                <input type="text" name="datas" placeholder="请输入URL地址" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="upgrades">升级</button>
                <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
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
    <button class="layui-btn layui-btn layui-btn-blue layui-btn-sm" onclick="x_admin_show('添加设备','<?php echo url('deviceadd'); ?>','400px','250px','95%','55%')"><i class="layui-icon"></i>添加</button>
</script>
<!--<script type="text/html" id="action" >
    <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑评论信息','<?php echo url('commentedit'); ?>?id={{d.id}}','700px','650px','95%','95%')">
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
    <a lay-event="del" tipsmsg="删除" class="layuimsg">
    <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
      <i class="layui-icon">&#xe640;</i>
    </button>
    </a>
</script>
<script>
    var groups = "";
    layui.use(['table','form','element'], function() {
        var table = layui.table,form = layui.form,element = layui.element, $ = layui.jquery;

        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("devicelist"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            limits:[10,100,200,400,600,1000,2000],
            page: true,
            cols: [[
                {checkbox:true,width: 80},
                {field: 'id', title: '硬件ID', width: 120,align: 'center',sort:true},
                {field: 'lmel', title: '硬件特征码',width:200,align: 'center'},
                {field: 'name', title: '分组名称',width:200},
             /*   {field: 'task_state', title: '空闲状态',width:120,align: 'center'},*/
                {field:'task_state',title: '空闲状态',width:120, align: 'center', toolbar: '#task_state'},
                {field: 'time', title: '添加时间',align: 'center',width:170,sort:true},
                {width: 120,title: '操作', align: 'center', toolbar: '#action'}
            ]],
            limit: 10, //每页默认显示的数量
            done:function(msgs){
                onmousemoves();
               /* console.log(msgs.data);*/
            }
        });

        //复选框选中的个数
        table.on('checkbox(list)', function (obj) {
            var checkStatus = table.checkStatus('list');
            var data = checkStatus.data;
            layer.msg('选中了：'+ data.length + ' 个');
        });

        //搜索
        $('#search').on('click', function() {
            var key = $('#key').val();
            var infomsg = $('#infomsg').val();
            if($.trim(key) == '') {
                layer.msg('搜索内容不能为空！');
                return false;
            }
            tableIn.reload({
                where: {key: key,infomsg:infomsg}
            })
        });

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
                layer.msg("请选择设备进行删除！");
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


        //任务清空
        $("#emptys").click(function(){
            pushtask("请选择设备进行清空！","<?php echo url('emptys'); ?>");
        })

        //设备重启
        $("#restart").click(function(){
            pushtask("请选择设备进行重启！","<?php echo url('restart'); ?>");
        })

        //软件升级
        $("#upgrade").click(function(){
           /* pushtask("请选择设备进行软件升级！","<?php echo url('upgrade'); ?>");*/
            var checkStatus = table.checkStatus('list'); //test即为参数uid设定的值
            var id = [];
            $(checkStatus.data).each(function (i, o) {
                id.push(o.id);
            });
            if (id == ""){
                layer.msg("请选择设备进行分组！");
                return false;
            }
            groups = id.toString();
            layer.open({
                type: 1,
                title: '要升级的软件网络URL',
                skin: 'layui-layer-lan',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                shade:0.4,
                anim: 1,
                area: screen() <2 ? ['95%','200px'] : ['400px', '200px'],
                content: $("#upgrades").html()
            });
            form.render();
        })

        //监听提交
        form.on('submit(upgrades)', function(data){
            data.field.id = groups;
            var urls = data.field.datas;
            if(urls == ""){
                layer.msg("URL地址不能为空!");
                return false;
            }
            $.post("<?php echo url('upgrade'); ?>",data.field,function(res){
                if(res.code == 1){
                    layer.msg(res.msg);
                    setTimeout(function(){
                        window.parent.location.reload();//修改成功后刷新父界面
                    }, 1000);
                }else if(res.code === 0) {
                    layer.msg(res.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
            },'json')
            return false;
        });

        function pushtask(msg,url){
            var checkStatus = table.checkStatus('list'); //test即为参数uid设定的值
            var id = [];
            $(checkStatus.data).each(function (i, o) {
                id.push(o.id);
            });
            if (id == ""){
                layer.msg(msg);
                return false;
            }
            var loading = layer.load(1, {shade: [0.1, '#fff']});
            id = id.toString();
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


        //加入分组
        $('#addgroups').click(function(){
            var checkStatus = table.checkStatus('list'); //test即为参数uid设定的值
            var id = [];
            $(checkStatus.data).each(function (i, o) {
                id.push(o.id);
            });
            if (id == ""){
                layer.msg("请选择设备进行分组！");
                return false;
            }
            groups = id.toString();
            layer.open({
                type: 1,
                title: '加入分组',
                skin: 'layui-layer-lan',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                shade:0.4,
                anim: 1,
                area: screen() <2 ? ['95%','75%'] : ['400px', '400px'],
                content: $("#test").html()
            });
            form.render();
        })

        //监听提交
        form.on('submit(addgroups)', function(data){
            data.field.list = groups;
            var ids = data.field.group_id;
            if(ids == ""){
                layer.msg("分组不能为空!");
                return false;
            }
            $.post("<?php echo url('addgroups'); ?>",data.field,function(res){
                if(res.code == 1){
                    layer.msg(res.msg);
                    setTimeout(function(){
                        window.parent.location.reload();//修改成功后刷新父界面
                    }, 1000);
                }else if(res.code === 0) {
                    layer.msg(res.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
            },'json')
            return false;
        });
    });
</script>
