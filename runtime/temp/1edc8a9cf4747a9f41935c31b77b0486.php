<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"C:\wamp64\www\public/../application/admin\view\user\userlist.html";i:1654614573;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654620072;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
                <div class="layui-inline layui-inlines">
                    <input class="layui-input"  id="starttime" placeholder="请输入开始时间">
                </div>
                <div class="layui-inline layui-inlines">
                    <input class="layui-input"  id="endtime" placeholder="请输入结束时间">
                </div>
                <span class="layui-form layui-input-inline box">
                    <select name="status" lay-filter="status" id="status">
                        <option value="">状态</option>
                        <option value="1">启用</option>
                        <option value="0">禁止</option>
                    </select>
                </span>
                <div class="layui-inline layui-inlines">
                    <input class="layui-input" name="key" id="key" placeholder="请输入查询内容">
                </div>
                <button class="layui-btn layui-btns layui-btn-blue" id="search" data-type="reload"><i class="layui-icon" style="color: #fff">&#xe615;</i>搜索</button>
               <!-- <button  tipsmsg="删除" class="layui-btn layui-btns layui-btn-red onmousemovebtns" id="delAll"><i class="layui-icon">&#xe640;</i>删除</button>-->
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
<script type="text/html" id="statu">
    {{# if(d.id==1){ }}
    <input type="checkbox" disabled name="statu" value="{{d.id}}" lay-skin="switch" lay-text="启用|禁止" lay-filter="statu" checked>
    {{# }else{  }}
    <input type="checkbox" name="statu" lay-skin="switch" lay-text="启用|禁止" value="{{d.id}}" lay-filter="statu" {{ d.statu == 1 ? 'checked' : '' }}>
    {{# } }}
</script>
<script type="text/html" id="endtimes">
    {{# if (d.id == 1) { }}  
    <a tipsmsg="未到期" class="layuimsg" href="javascript:;">
        <button class="layui-btn layui-btn-green layui-btn-xs layui-btns">
            未到期
        </button>
    </a>
    {{# } else if(d.nowtime > d.endtimes) { }}  
    <a tipsmsg="已到期" class="layuimsg" href="javascript:;">
        <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
            已到期
        </button>
    </a>
    {{# } else { }}  
    <a tipsmsg="未到期" class="layuimsg" href="javascript:;">
        <button class="layui-btn layui-btn-green layui-btn-xs layui-btns">
           未到期
        </button>
    </a>
    {{# } }}  
</script>
<script type="text/html" id="topBtn">
    <button tipsmsg="添加" class="layui-btn layui-btn layui-btn-blue layui-btn-sm onmousemovebtns"
            onclick="x_admin_show('添加用户','<?php echo url('useradd'); ?>','500px','500px','95%','95%')">
        <i class="layui-icon"></i>添加
    </button>
</script>
<script type="text/html" id="action" >
    <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑用户信息','<?php echo url('useredit'); ?>?id={{d.id}}','450px','360px','95%','80%')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a>
    <a tipsmsg="修改密码" class="layuimsg" onclick="x_admin_show('编辑用户密码','<?php echo url('editpass'); ?>?id={{d.id}}','400px','240px','95%','55%')">
        <button class="layui-btn layui-btn-xs layui-btns layui-btn-green">
            <i class="layui-icon">&#xe673;</i>
        </button>
    </a>
    {{# if(d.id!=1){ }}
    <a tipsmsg="配置权限" class="layuimsg" onclick="x_admin_show('配置权限','<?php echo url('groupaccess'); ?>?id={{d.id}}','','','95%','95%')">
        <button class="layui-btn layui-btns layui-btn-black layui-btn-xs">
            <i class="layui-icon">&#xe716;</i>
        </button>
    </a>
    {{# }else{  }}
    <a tipsmsg="配置权限" class="layuimsg" href="javascript:;">
        <button class="layui-btn layui-btn-primary layui-btn-xs layui-btn-disabled">
            <i class="layui-icon">&#xe716;</i>
        </button>
    </a>
    {{# } }}
    <a tipsmsg="授权登录" class="layuimsg" href="javascript:void(0)" lay-event="login" id="login">
        <button class="layui-btn layui-btn-xs layui-btns layui-btn-violet layui-btn-padding">
            <i class="fa fa-sign-in" aria-hidden="true"></i>
        </button>
    </a>
    {{# if(d.id==1){ }}
    <a tipsmsg="删除" class="layuimsg">
    <button class="layui-btn layui-btn-xs layui-btn-primary layui-btn-disabled">
    {{# }else{  }}
    <a lay-event="del" tipsmsg="删除" class="layuimsg">
    <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
    {{# } }}
    <i class="layui-icon">&#xe640;</i>
    </button>
    </a>
</script>
<script>
    layui.use(['table','form','element','laydate'], function() {
        var table = layui.table,form = layui.form,element = layui.element,laydate = layui.laydate, $ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("userlist"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            title: '用户数据信息',
           // totalRow: true,
            page: true,
            cols: [[
               /* {checkbox:true,width: 80},*/
                {field: 'id', title: '编号', width: 100,align: 'center',sort:true},
                {field: 'username', title: '用户名',width:120},
                {field: 'phone', title: '手机号码',width:140},
                {field: 'appkey', title: 'APPKEY',width:300},
                {field: 'statu',title: '状态',width:100, align: 'center', toolbar: '#statu'},
                {field: 'addtime', title: '添加时间',align: 'center',width:170,sort:true},
                {title: '是否到期',width:90, align: 'center', toolbar: '#endtimes'},
                {field: 'endtime', title: '到期时间',align: 'center',width:170,sort:true},
                {field: 'logintime', title: '最后登录时间',align: 'center',width:170,sort:true},
                {width: 190,title: '操作', align: 'center', toolbar: '#action',fixed:'right'}
            ]],
            limits:[10,100,200,400,600,1000,2000],
            limit: 10, //每页默认显示的数量
            done:function(res){
                onmousemoves();
            }
        });

        //监听单元格编辑
        table.on('edit(list)', function(obj){
            var value = obj.value //得到修改后的值
                ,data = obj.data //得到所在行所有键值
            var arrs ={
                id:data.id,//验证的数据类类型
                name:value//提交的数据
            };
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post('<?php echo url("platformedit"); ?>',arrs,function(res){
                layer.close(loading);
                if(res.code===1){
                    layer.msg(res.msg);
                    tableIn.reload();
                }else if(res.code===0){
                    layer.msg(res.msg);
                }else{
                    layer.msg('你无操作权限!')  ;
                }
            },'json')
        });

        //复选框选中的个数
        table.on('checkbox(list)', function (obj) {
            var checkStatus = table.checkStatus('list');
            var data = checkStatus.data;
            layer.msg('选中了：'+ data.length + ' 个');
        });

        laydate.render({
            elem: '#starttime'
            ,theme: '#4476A7'
            ,max: 'new Date()'
        });

        laydate.render({
            elem: '#endtime'
            ,theme: '#4476A7'
            ,max: 1
        });

        form.on('select(status)', function(data){
            tableIn.reload({
                where: {statu: data.value}
            });
        })

        //搜索
        $('#search').on('click', function() {
            var key = $('#key').val();
            var starttime = $("#starttime").val();
            var endtime = $("#endtime").val();
            var t1 = new Date(starttime);
            var t2 = new Date(endtime);
            if((t2 - t1) < 0){
                layer.msg('时间范围选择错误！');
                return false;
            }
            var status = $('#status').val();
            if($.trim(key) == '' && starttime == "" && endtime == "") {
                layer.msg('搜索内容不能为空！');
                return false;
            }
            tableIn.reload({
                where: {key: key,starttime:starttime,endtime:endtime,statu:status}
            })
        });

        //修改状态
        form.on('switch(statu)', function(obj){
            var urls = "<?php echo url('userstatu'); ?>";
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var statu = obj.elem.checked===true?1:0;
            $.post(urls,{'id':id,'statu':statu},function(res) {
                layer.close(loading);
                if(res.code===1){
                    layer.msg(res.msg);
                    tableIn.reload();
                }else if(res.code===0){
                    layer.msg(res.msg);
                }else{
                    layer.msg('你无操作权限！');
                }
            },'json');
        });


        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除该信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('userdel'); ?>",{id:data.id},function(res){
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
            }else{
                var loading = layer.load(1, {shade: [0.1, '#fff']});
                $.post("<?php echo url('user/login/indexs'); ?>",{id:data.id},function(res){
                    layer.close(loading);
                    if(res.code===1){
                        layer.msg(res.msg,function(){
                            window.open("<?php echo url('user/index/index'); ?>", "_blank");
                        });
                    }else if(res.code === 0) {
                        layer.msg(res.msg);
                    }else{
                        layer.msg('你无操作权限！');
                    }
                },'json');
            }
        });

        /*$('#delAll').click(function(){
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
                $.post("<?php echo url('userdel'); ?>", {id: id}, function (data) {
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
        })*/
    });
</script>
