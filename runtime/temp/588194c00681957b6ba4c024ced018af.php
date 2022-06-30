<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"C:\wamp64\www\public/../application/admin\view\auth\adminlist.html";i:1654601229;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654616318;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
    .layui-table-body .layui-table-cell{
        height: 30px;
        line-height: 30px;
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
<div class="layui-row">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="demoTable">
                <span class="layui-form layui-input-inline box">
                    <select name="statu" lay-filter="statu" id="statu">
                        <option value="">状态</option>
                        <option value="1">启用</option>
                        <option value="0">禁止</option>
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
<script type="text/html" id="imgs">
    {{# if(d.avatar != ""){ }}
    <div class="layer-photos-demo"><img src="/public{{d.avatar}}" width="30" height="30"></div>
    {{# } }}
</script>
<script type="text/html" id="topBtn">
    <button class="layui-btn layui-btn layui-btn-blue layui-btn-sm" onclick="x_admin_show('添加管理员','<?php echo url('adminadd'); ?>','580px','580px','95%','95%')"><i class="layui-icon"></i>添加</button>
</script>
<script type="text/html" id="open">
    {{# if(d.adminid==1){ }}
       <input type="checkbox" disabled name="is_open" value="{{d.adminid}}" lay-skin="switch" lay-text="启用|禁止" lay-filter="open" checked>
    {{# }else{  }}
       <input type="checkbox" name="is_open" lay-skin="switch" lay-text="启用|禁止" value="{{d.adminid}}" lay-filter="open" {{ d.is_open == 1 ? 'checked' : '' }}>
    {{# } }}
</script>
<script type="text/html" id="action">
    <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑管理员信息','<?php echo url('adminedit'); ?>?id={{d.adminid}}','500px','500px','95%','95%')">
        <button class="layui-btn layui-btns layui-btn-blue layui-btn-xs">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a>
    <a lay-event="upload" tipsmsg="上传头像" class="layuimsg" id="head">
        <button class="layui-btn layui-btn-black layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe67c;</i>
        </button>
    </a>
    <a tipsmsg="修改密码" class="layuimsg" onclick="x_admin_show('编辑管理员密码','<?php echo url('editpass'); ?>?id={{d.adminid}}','400px','240px','95%','55%')">
    <button class="layui-btn layui-btn-xs layui-btns layui-btn-green">
      <i class="layui-icon">&#xe673;</i>
    </button>
    </a>
    {{# if(d.adminid==1){ }}
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
/*    var pages = $("#pages").val();*/
    var adminids = "";
    var loadings = "";
    layui.use(['table','form','element','upload'], function() {
        var table = layui.table,form = layui.form,element = layui.element,upload = layui.upload,$ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("adminlist"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            title: '管理员数据信息',
            page: true,
            cols: [[
/*                {checkbox:true,fixed: true},*/
                {field: 'adminid', title: '编号', width: 80,align: 'center',sort:true},
                {field: 'username', title: '用户名',width:120},
                {field: 'title', title: '用户组',width:120},
                {field: 'email', title: '邮箱',width:180},
                {field: 'tel', title: '手机号码',width:130},
                {field: 'loginip', title: '登录IP',width:110},
                {field: 'ipadress', title: '登录IP地址',width:110},
                {field: 'loginnum', title: '登录次数',width:100},
                {field: 'add_time', title: '注册时间',align: 'center',width:170,sort:true},
                {field: 'logintime', title: '最后登录时间',align: 'center',width:170,sort:true},
                {width: 60,title: '头像', toolbar: '#imgs'},
                {field:'is_open',title: '状态',width:95, align: 'center', toolbar: '#open'},
                {width: 160,title: '操作', align: 'center', toolbar: '#action',fixed: 'right'}
            ]],

            done:function(msg){
                 onmousemoves();
                 hoverOpenImg();//显示大图
                 photos()
                 uploads();
            }
        });

        //点击显示图片
        function photos()
        {
            layer.photos({
                photos: 'td .layer-photos-demo'
                ,anim: 3 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
            });
        }

        //图片放大
        function hoverOpenImg(){
            var img_show = null; // tips提示
            $('td img').hover(function(){
                var img = "<img class='img_msg' src='"+$(this).attr('src')+"' style='width:130px;padding:10px 5px;' />";
                img_show = layer.tips(img, this,{
                    tips:[2, 'rgba(0,0,0,.5)']
                    ,area: ['170px']
                });
            },function(){
                layer.close(img_show);
            });
            $('td img').attr('style','max-width:70px');
        }

        //上传头像
        function uploads(){
            var uploadInst = upload.render({
                elem: 'td #head'
                ,url: '<?php echo url("upimagesinfo"); ?>'
                ,auto:true
                ,bindAction:'td #head'
                ,before: function(obj){
                    loadings = layer.load(2, { //icon支持传入0-2
                        shade: [0.3, 'black'], //0.5透明度的灰色背景
                        content: '上传中',
                        success: function (layero) {
                            layero.find('.layui-layer-content').css({
                                'text-indent': '-5px',
                                'padding-top': '39px',
                                'width': '60px'
                            });
                        }
                    });
                    this.data={files:'admin',adminid:adminids};//关键代码
                }
                ,done: function(res){
                    layer.close(loadings);
                    if(res.code===1){
                        layer.msg(res.msg);
                        tableIn.reload();
                    }else if(res.code===0){
                        layer.msg(res.msg);
                        return false;
                    }else{
                        layer.msg('你无操作权限！');
                        return false;
                    }
                }
                ,error: function(){
                    layer.msg('上传失败');
                    return false;
                }
            });
        }

        //粉丝类型筛选
        form.on('select(statu)', function(data){
            tableIn.reload({ 
                where: {is_open: data.value}
            });
        })

        //搜索
        $('#search').on('click', function() {
            var key = $('#key').val();
            var statu = $('#statu').val();
            if($.trim(key) == '' && statu == '') {
                layer.msg('搜索内容不能为空！');
                return false;
            }
            tableIn.reload({
                where: {key: key,is_open:statu}
            })
        });


        table.on('tool(list)', function(obj) {
            var data = obj.data;
            if (obj.event === 'del') {
                layer.confirm('您确定要删除该信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('admindel'); ?>",{id:data.adminid},function(res){
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
                    layer.close(index);
                });
            }else{
                adminids = data.adminid;
                //普通图片上传
            }
        });

         //修改状态
        form.on('switch(open)', function(obj){
            var urls = "<?php echo url('admineditopen'); ?>";
            loading =layer.load(1, {shade: [0.1,'#fff']});
            var id = this.value;
            var is_open = obj.elem.checked===true?1:0;
            $.post(urls,{'id':id,'is_open':is_open},function(res) {
                layer.close(loading);
                if(res.code===1){
                    layer.msg(res.msg);
                    tableIn.reload();
                }else if(res.code===0){
                    layer.msg(res.msg);
                }else{
                    layer.msg('你无操作权限!');
                    tableIn.reload();
                }
            },'json');
        });

        $('#delAll').click(function(){
            var checkStatus = table.checkStatus('list'); //test即为参数uid设定的值
            var uids = [];
            $(checkStatus.data).each(function (i, o) {
                uids.push(o.adminid);
            });
            if (uids == ""){
                layer.msg("请选择内容进行删除");
                return false;
            }
            layer.confirm('确认要删除选中信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index) {
                layer.close(index);
                var loading = layer.load(1, {shade: [0.1, '#fff']});
                $.post("<?php echo url('delall'); ?>", {uids: uids}, function (data) {
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
