<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"C:\wamp64\www\public/../application/admin\view\index\index.html";i:1654863319;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654620072;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
<style>
    .layui-carousel-ind
    {
        position: absolute;
    }
    .layui-carousel-ind ul{
        position: absolute;
        right: 0;top: -5px;
        background: none;
    }
    .layui-carousel-ind ul:hover{
        background: none;
    }
    .layui-carousel-ind ul .layui-this{
        background: #e2e2e2;
    }
    .layui-carousel-ind ul :hover{
        background: #e2e2e2;
    }
    .layui-carousel-ind ul li{
        background:black;
    }
    textarea{
        font-family: "微软雅黑" !important;
        padding: 10px;
    }
    .bolds{
        font-weight:bold;
    }
    .font-icons{
        font-size:30px;
    }

</style>
<div class="layui-col-sm12 layui-col-md12">
    <div class="layui-card">
        <blockquote class="layui-elem-quote" style="background: #fff !important;">
            <legend>
                <div>
                    <i class="layui-icon">&#xe66f;</i> 欢迎登陆：
                    <span class="x-red"><?php echo session('username'); ?> </span>
                    <span id="nowTime"></span>
                </div>
            </legend>
        </blockquote>
    </div>
</div>
<div class="layui-row layui-col-space20">
    <div class="layui-col-sm6 layui-col-md3" onclick="window.location.href='<?php echo url('device/devicelist'); ?>'">
        <div class="layui-card">
            <div class="layui-card-body chart-card">
                <div class="chart-header">
                    <div class="metawrap">
                        <div class="meta">
                            <span>本月订单量</span>
                        </div>
                        <div class="total"><?php echo $infos['ordermonth']; ?></div>
                    </div>
                    <div class="layui-layout-right">
                        <i class="fa fa-building font-icons" aria-hidden="true" style="color:#177ce3;"></i>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="contentwrap">

                    </div>
                </div>
                <div class="chart-footer">
                    <div class="field">
                        <span>总单量: </span>
                        <span class="bolds"><?php echo $infos['orderzl']; ?></span>&nbsp;&nbsp;
                        <span>本周单量: </span>
                        <span class="bolds"><?php echo $infos['orderweek']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-col-sm6 layui-col-md3" onclick="window.location.href='<?php echo url('user/userlist'); ?>'">
        <div class="layui-card">
            <div class="layui-card-body chart-card">
                <div class="chart-header">
                    <div class="metawrap">
                        <div class="meta">
                            <span>总会员数</span>
                        </div>
                        <div class="total"><?php echo $infos['vipzl']; ?></div>
                    </div>
                    <div class="layui-layout-right">
                        <i class="fa fa-user font-icons" aria-hidden="true" style="color:#009688"></i>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="contentwrap">

                    </div>
                </div>
                <div class="chart-footer">
                    <div class="field">
                        <span>本月新增会员数</span>
                        <span class="bolds"><?php echo $infos['vipmonth']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-body chart-card">
                <div class="chart-header">
                    <div class="metawrap">
                        <div class="meta">
                            <span>会员订单</span>
                        </div>
                        <div class="total"><?php echo $infos['vip_orderlis']; ?></div>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="contentwrap">

                    </div>
                </div>
                <div class="chart-footer">
                    <div class="field">
                        <span>本月会员订单资金</span>
                        <span>待定</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-col-sm6 layui-col-md3">
        <div class="layui-card">
            <div class="layui-card-body chart-card">
                <div class="chart-header">
                    <div class="metawrap">
                        <div class="meta">
                            <span>本月非会员订单</span>
                        </div>
                        <div class="total"><?php echo $infos['no_vip_orderlis']; ?></div>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="contentwrap">

                    </div>
                </div>
                <div class="chart-footer">
                    <div class="field">
                        <span>非会员订单资金</span>
                        <span>待定</span>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="layui-row layui-col-space15">
        <div class="layui-col-md6">
            <div class="layui-card">

        <div class="layui-card-body">
            <div class="demoTable">
 <span>订单信息表</span>
                <div class="layui-inline layui-inlines">
                    <input class="layui-input" name="key" id="key" placeholder="请输入电话查询">
                </div>
                <button class="layui-btn layui-btns layui-btn-blue" id="search" data-type="reload"><i class="layui-icon" style="color: #fff">&#xe615;</i>搜索</button>
               <!-- <button  tipsmsg="删除" class="layui-btn layui-btns layui-btn-red onmousemovebtns" id="delAll"><i class="layui-icon">&#xe640;</i>删除</button>-->
            </div>
               <table class="layui-table" id="list" lay-filter="list"></table>
            </div>
        </div>
</div>
         <div class="layui-col-md6">
            <div class="layui-card">


        <div class="layui-card-body">
            <div class="demoTable">
 <span>VIP会员表</span>
                <div class="layui-inline layui-inlines">
                    <input class="layui-input" name="keys" id="keys" placeholder="请输入电话查询">
                </div>
                <button class="layui-btn layui-btns layui-btn-blue" id="vipsel" data-type="reload"><i class="layui-icon" style="color: #fff">&#xe615;</i>搜索</button>
               <table class="layui-table" id="viplist" lay-filter="viplist"></table>
            </div>
        </div>
    </div>
</div>


  




    <div class="layui-row layui-col-space15">
        <div class="layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">
                    <div class="infos layui-btns layui-btn-green">
                        <i class="fa fa-assistive-listening-systems facolors" aria-hidden="true"></i>
                    </div> 系统信息
                </div>
                <div class="layui-card-body">
                    <table  class="layui-table" lay-even lay-skin="row">
                        <tbody>
                            <tr>
                                <th>网站域名</th>
                                <td><?php echo $config['url']; ?></td>
                            </tr>
                            <tr>
                                 <th>网站目录</th>
                                 <td><?php echo $config['document_root']; ?></td>
                             </tr> 
                            <tr>
                                <th>服务器操作系统</th>
                                <td><?php echo $config['server_os']; ?></td>
                            </tr>
                            <tr>
                                <th>服务器端口</th>
                                <td><?php echo $config['server_port']; ?></td>
                            </tr>
                            <tr>
                                <th>服务器IP</th>
                                <td><?php echo $config['server_ip']; ?></td>
                            </tr>
                            <tr>
                                <th>WEB运行环境</th>
                                <td><?php echo $config['server_soft']; ?></td>
                            </tr>
                            <tr>
                                <th>MySQL数据库版本</th>
                                <td><?php echo $config['mysql_version']; ?></td>
                            </tr>
                            <tr>
                                <th>运行PHP版本</th>
                                <td><?php echo $config['php_version']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="layui-col-md6">
            <div class="layui-card">
                <div class="layui-card-header">
                    <div class="infos layui-btns layui-btn-red">
                        <i class="fa fa-user-o facolors" aria-hidden="true"></i>
                    </div> 我的个人信息
                </div>
                <div class="layui-card-body">
                    <table  class="layui-table" lay-even lay-skin="row">
                        <tbody>
                            <tr>
                                <th>你好，<?php echo session('username'); ?> 欢迎你登录！</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>本次登录时间</th>
                                <td><?php echo date('Y-m-d H:i:s',$admininfo['logintime']); ?></td>
                            </tr>
                            <tr>
                                <th>上次登录时间</th>
                                <td>
                                    <?php if(session('logintime') != ''): ?>
                                    <?php echo date('Y-m-d H:i:s',session('logintime')); endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>上次登录IP</th>
                                <td><?php echo session('loginip'); ?></td>
                            </tr>
                            <tr>
                                <th>上次登录IP地址</th>
                                <td><?php echo session('ipadress'); ?></td>
                            </tr>
                            <tr>
                                <th>登陆次数</th>
                                <td><?php echo $admininfo['loginnum']; ?></td>
                            </tr>
                            <tr>
                                <th>手机号码</th>
                                <td><?php echo $admininfo['tel']; ?></td>
                            </tr>
                            <tr>
                                <th>当前时间</th>
                                <td id="nowTimes"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
<script type="text/javascript" src="/public/static/common/js/echarts.min.js"></script>
<script>
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        carousel.render({
            elem: '#test1'
            ,width: '100%' //设置容器宽度
            ,height: '200px'
            ,arrow: 'none' //始终显示箭头
            //,anim: 'updown' //切换动画方式
            ,interval: 5000
        });
    });
</script>
<script type="text/javascript">
    //获取系统时间
    var newDate = '';
    getLangDate();
    //值小于10时，在前面补0
    function dateFilter(date){
        if(date < 10){return "0"+date;}
        return date;
    }
    function getLangDate(){
        var dateObj = new Date(); //表示当前系统时间的Date对象
        var year = dateObj.getFullYear(); //当前系统时间的完整年份值
        var month = dateObj.getMonth()+1; //当前系统时间的月份值
        var date = dateObj.getDate(); //当前系统时间的月份中的日
        var day = dateObj.getDay(); //当前系统时间中的星期值
        var weeks = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
        var week = weeks[day]; //根据星期值，从数组中获取对应的星期字符串
        var hour = dateObj.getHours(); //当前系统时间的小时值
        var minute = dateObj.getMinutes(); //当前系统时间的分钟值
        var second = dateObj.getSeconds(); //当前系统时间的秒钟值
        var timeValue = "" +((hour >= 12) ? (hour >= 18) ? "晚上" : "下午" : "上午" ); //当前时间属于上午、晚上还是下午
        newDate = dateFilter(year)+"年"+dateFilter(month)+"月"+dateFilter(date)+"日 "+" "+dateFilter(hour)+":"+dateFilter(minute)+":"+dateFilter(second);
        document.getElementById("nowTime").innerHTML = timeValue+"好！当前时间为： "+newDate+"　"+week;
        document.getElementById("nowTimes").innerHTML = newDate+"　"+week;
        setTimeout("getLangDate()",1000);
    }
</script>
<script type="text/javascript">
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        color: ['#003366', '#4cabce'],
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['在线设备','离线设备']
        },
        series : [
            {
                name: '平台设备',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:<?php echo $device['online']; ?>, name:'在线设备'},
                    {value:<?php echo $device['offline']; ?>, name:'离线设备'},
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>














<script type="text/html" id="statu">
    <input type="checkbox" name="statu" lay-skin="switch" lay-text="启用|禁止" value="{{d.id}}" lay-filter="statu" {{ d.statu == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="topBtn">
    <button tipsmsg="添加" class="layui-btn layui-btn layui-btn-blue layui-btn-sm onmousemovebtns" onclick="x_admin_show('添加订单','<?php echo url('order/orderadd'); ?>','700px','650px','95%','95%')"><i class="layui-icon"></i>添加订单</button>
</script>
<script type="text/html" id="action" >
<!--     <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑评论信息','<?php echo url('commentedit'); ?>?id={{d.id}}','700px','650px','95%','95%')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a> -->
    <a lay-event="del" tipsmsg="删除" class="layuimsg">
        <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe640;</i>
        </button>
    </a>
</script>


<script type="text/html" id="addvip">
    <button tipsmsg="添加" class="layui-btn layui-btn layui-btn-blue layui-btn-sm onmousemovebtns" onclick="x_admin_show('添加会员','<?php echo url('vip/vipadd'); ?>','700px','650px','95%','95%')"><i class="layui-icon"></i>增加VIP</button>
</script>
<script type="text/html" id="actions" >
<!--     <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('编辑评论信息','<?php echo url('commentedit'); ?>?id={{d.id}}','700px','650px','95%','95%')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a> -->
    <a lay-event="vipdel" tipsmsg="删除" class="layuimsg">
        <button class="layui-btn layui-btn-red layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe640;</i>
        </button>
    </a>

        <a tipsmsg="编辑" class="layuimsg" onclick="x_admin_show('更改会员信息','<?php echo url('vip/vipedit'); ?>?id={{d.hyid}}','450px','360px','95%','80%')">
        <button class="layui-btn layui-btn-blue layui-btn-xs layui-btns">
            <i class="layui-icon">&#xe642;</i>
        </button>
    </a>
</script>


<script>
    layui.use(['table','form','element','laydate'], function() {
        var table = layui.table,form = layui.form,element = layui.element,laydate = layui.laydate, $ = layui.jquery;
        var tableIn = table.render({
            elem: '#list',
            url: '<?php echo url("index"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#topBtn',
            title:'抖音账号数据信息',
            page: true,
            cols: [[
                //{checkbox:true,width: 80},
                {field: 'order_id', title: '编号', width: 80,align: 'center',sort:true},
                {field: 'tel', title: '是否会员',width:130,align: 'center'},
                {field: 'sf_name', title: '跟单师傅',width:100,align: 'center'},
               // {field: 'statu',title: '订单金额',width:100, align: 'center', toolbar: '#statu'},
               {field: 'yuanjia',title: '原价',width:100, align: 'center'},
                 {field: 'zh',title: '实际金额',width:100, align: 'center'},
               {field: 'xiagmu',title: '项目',width:100, align: 'center'},
                {field: 'fk_time', title: '付款时间',align: 'center',width:170,sort:true},
                {field: 'zk', title: '折扣享受',align: 'center',width:110},
{width: 90,title: '操作', align: 'center', toolbar: '#action'}
               // {width: 120,title: '折扣享受', align: 'center', toolbar: '#action'},
                //{field: 'addtime', title: '付款时间',align: 'center',width:170,sort:true}
            ]],
            limit: 10, //每页默认显示的数量
            done:function(msg){
                onmousemoves();
                 console.log(msg.datas);
            }
        });


  var tableIns = table.render({
            elem: '#viplist',
            url: '<?php echo url("viplist"); ?>',
            text:{none: '<i class="fa fa-snowflake-o" aria-hidden="true"></i>&nbsp;暂无相关数据'},
            method: 'post',
            toolbar: '#addvip',
            title:'抖音账号数据信息',
            page: true,
            cols: [[
                //{checkbox:true,width: 80},
                {field: 'hyid', title: 'ID', width: 80,align: 'center',sort:true},
                {field: 'tel', title: '会员账号',width:130,align: 'center'},
                {field: 'money', title: '会员资金',width:100,align: 'center'},
               // {field: 'statu',title: '订单金额',width:100, align: 'center', toolbar: '#statu'},
             
                 {field: 'discount',title: '会员折扣',width:100, align: 'center'},
                 {field: 'mima',title: '密码',width:100, align: 'center',hide: true },
               {field: 'date',title: '创建日期',width:100, align: 'center'},
{width: 100,title: '操作', align: 'center', toolbar: '#actions'}
               // {width: 120,title: '折扣享受', align: 'center', toolbar: '#action'},
                //{field: 'addtime', title: '付款时间',align: 'center',width:170,sort:true}
            ]],
            limit: 10, //每页默认显示的数量
            done:function(msg){
                onmousemoves();
                 console.log(msg.datas);
            }
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

      
            if($.trim(key) == '') {
                layer.msg('搜索内容不能为空！');
                return false;
            }
            tableIn.reload({
                where: {key: key}
            })
        });


        //搜索
        $('#vipsel').on('click', function() {
            var keys = $('#keys').val();

      
            if($.trim(keys) == '') {
                layer.msg('搜索内容不能为空！');
                return false;
            }
            tableIns.reload({
                where: {keys: keys}
            })
        });



        //修改状态
        form.on('switch(statu)', function(obj){
            var urls = "<?php echo url('accounteditstatu'); ?>";
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
                    $.post("<?php echo url('order/order_del'); ?>",{id:data.order_id},function(res){
                        layer.close(loading);
                        if(res.code===1){
                            layer.msg(res.msg);
                            tableIn.reload();
                        }else if(res.code === 0) {
                            layer.msg(res.msg);
                        }else{
                           // layer.msg('你无操作权限！');
                        }
                    },'json');
                    layer.close(index);
                });
            }
        });
        table.on('tool(viplist)', function(obj) {
            var data = obj.data;
            if (obj.event === 'vipdel') {
                layer.confirm('您确定要删除该信息吗？', {icon: 3,skin: 'layui-layer-lan',anim: 4,title:'删除'}, function(index){
                    var loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.post("<?php echo url('vip/vip_del'); ?>",{id:data.hyid},function(res){
                        layer.close(loading);
                        if(res.code===1){
                            layer.msg(res.msg);
                            tableIns.reload();
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
                $.post("<?php echo url('accountdel'); ?>", {id: id}, function (data) {
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