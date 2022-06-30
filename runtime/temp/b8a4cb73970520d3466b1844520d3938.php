<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"C:\wamp64\www\public/../application/admin\view\index\chart.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654620072;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
    textarea{
        font-family: "微软雅黑" !important;
        padding: 10px;
    }
</style>
<div class="layui-row layui-col-space20">
    <div class="layui-col-sm12 layui-col-md12">
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">账号管理</li>
                    <li>活跃度</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div id="container" style="width: 100%;height: 400px;"></div>
                    </div>
                    <div class="layui-tab-item">
                        ddd
                    </div>
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
<script type="text/javascript">
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    var posList = [
        'left', 'right', 'top', 'bottom',
        'inside',
        'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
        'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
    ];

    app.configParameters = {
        rotate: {
            min: -90,
            max: 90
        },
        align: {
            options: {
                left: 'left',
                center: 'center',
                right: 'right'
            }
        },
        verticalAlign: {
            options: {
                top: 'top',
                middle: 'middle',
                bottom: 'bottom'
            }
        },
        position: {
            options: echarts.util.reduce(posList, function (map, pos) {
                map[pos] = pos;
                return map;
            }, {})
        },
        distance: {
            min: 0,
            max: 100
        }
    };

    app.config = {
        rotate: 90,
        align: 'left',
        verticalAlign: 'middle',
        position: 'insideBottom',
        distance: 15,
        onChange: function () {
            var labelOption = {
                normal: {
                    rotate: app.config.rotate,
                    align: app.config.align,
                    verticalAlign: app.config.verticalAlign,
                    position: app.config.position,
                    distance: app.config.distance
                }
            };
            myChart.setOption({
                series: [{
                    label: labelOption
                }, {
                    label: labelOption
                }, {
                    label: labelOption
                }, {
                    label: labelOption
                }]
            });
        }
    };


    var labelOption = {
        normal: {
            show: true,
            position: app.config.position,
            distance: app.config.distance,
            align: app.config.align,
            verticalAlign: app.config.verticalAlign,
            rotate: app.config.rotate,
            formatter: '{c}  {name|{a}}',
            fontSize: 16,
            rich: {
                name: {
                    textBorderColor: '#fff'
                }
            }
        }
    };

    option = {
       /* backgroundColor: '#f0f2f5',
        title: {
            left: 'center',
            textStyle: {
                color: '#eee'
            }
        },*/
        color: ['#003366', '#006699', '#4cabce', '#e5323e'],
        /*title: {
            text: '账号管理',
            x:'center',
            y:'bottom',

        },*/
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: ['小红书', '百度', '快手', '抖音']
        },//侧边栏显示
        toolbox: {
            show: true,
            orient: 'vertical',
            left: 'right',
            top: 'center',
            feature: {
                mark: {show: true},
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        calculable: true,
        xAxis: [
            {
                type: 'category',
                axisTick: {show: false},
                data: [
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    '<?php echo $vo['time']; ?>',
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ],
                /*axisLabel: {
                    formatter: function(value) {
                        var res = value;
                        if(widths < 750) {
                            value.substring(0, 0);
                            res = "";
                        }
                        return res;

                    }
                }*/
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: '小红书',
                type: 'bar',
                /*barGap: 0,*/
               /* label: labelOption,*/
                /*label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },*/
               /* markPoint: {
                    data: [
                        {type: 'max', name: '最大值'},
                        {type: 'min', name: '最小值'}
                    ]
                },*/
/*                markLine: {
                    data: [
                        {type: 'average', name: '平均值'}
                    ]
                },*/
                data:[
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <?php echo $vo['count']; ?>,
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            },
            {
                name: '百度',
                type: 'bar',
                data:[
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <?php echo $vo['count']; ?>,
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            },
            {
                name: '快手',
                type: 'bar',
                data:[
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <?php echo $vo['count']; ?>,
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            },
            {
                name: '抖音',
                type: 'bar',
                data:[
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <?php echo $vo['count']; ?>,
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            }
        ]
    };
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
