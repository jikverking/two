<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"C:\wamp64\www\public/../application/admin\view\trill\commenting.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654616318;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
<script type="text/html" id="statu">
    <input type="checkbox" name="statu" lay-skin="switch" lay-text="启用|禁止" value="{{d.id}}" lay-filter="statu" {{ d.statu == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="topBtn">
    <button tipsmsg="添加" class="layui-btn layui-btn layui-btn-blue layui-btn-sm onmousemovebtns"
            onclick="x_admin_show('添加分组','<?php echo url('commentingadd'); ?>','400px','250px','95%','250px')">
        <i class="layui-icon"></i>添加
    </button>
</script>
<script type="text/html" id="action" >
    <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑评论分组信息','<?php echo url('commentingedit'); ?>?id={{d.id}}','400px','200px','95%','200px')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a>
    {{# if(d.statu == 0){ }}
    <a tipsmsg="分组" class="layuimsg">
        <button class="layui-btn layui-btn-xs layui-btn-primary layui-btn-disabled">
    {{# }else{  }}
        <a tipsmsg="分组" class="layuimsg" href="<?php echo url('commentlist'); ?>?id={{d.id}}">
            <button class="layui-btn layui-btn-green layui-btn-xs layui-btns" style="padding: 0px 8px 0px 8px">
    {{# } }}
        <i class="fa fa-object-group" aria-hidden="true"></i>
        </button>
    </a>
<!--    <a tipsmsg="分组" class="layuimsg" href="<?php echo url('commentlist'); ?>?id={{d.id}}">
        <button class="layui-btn layui-btn-green layui-btn-xs layui-btns" style="padding: 0px 8px 0px 8px">
            <i class="fa fa-object-group" aria-hidden="true"></i>
        </button>
    </a>-->
    <a tipsmsg="查看评论" class="layuimsg" href="<?php echo url('commentlist'); ?>?ids={{d.id}}">
        <button class="layui-btn layui-btn-black layui-btn-xs layui-btns" style="padding: 0px 8px 0px 8px">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </button>
    </a>
    <a lay-event="del" tipsmsg="删除" class="layuimsg">
        <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe640;</i>
        </button>
    </a>
</script>
<script>
    layui.use(['table','form','element','laydate'], function() {
        var table = layui.table,form = layui.form,element = layui.element,laydate = layui.laydate, $ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("commenting"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            page: true,
            cols: [[
                {checkbox:true,width: 80},
                {field: 'id', title: '编号', width: 120,align: 'center',sort:true},
                {field: 'name', title: '分组名称',width:200,align: 'center', edit: 'text'},
                {field: 'num', title: '组内评论数量',width:150,align: 'center',sort:true},
                {field: 'statu',title: '状态',width:100, align: 'center', toolbar: '#statu'},
                {field: 'addtime', title: '操作时间',align: 'center',width:170,sort:true},
                {width: 200,title: '操作', align: 'center', toolbar: '#action'}
            ]],
            limit: 10, //每页默认显示的数量
            done:function(msg){
                onmousemoves();
                /* console.log(msg.data);*/
            }
        });

        //监听单元格编辑
        table.on('edit(list)', function(obj){
            var value = obj.value //得到修改后的值
                ,data = obj.data //得到所在行所有键值
                ,field = obj.field; //得到字段
            var arrs ={
                id:data.id,//验证的数据类类型
                name:value//提交的数据
            };
            loading =layer.load(1, {shade: [0.1,'#fff']});
            $.post('<?php echo url("commentingedit"); ?>',arrs,function(res){
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
            var urls = "<?php echo url('commentingstatu'); ?>";
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
                    $.post("<?php echo url('commentingdel'); ?>",{id:data.id},function(res){
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
                $.post("<?php echo url('commentingdel'); ?>", {id: id}, function (data) {
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
