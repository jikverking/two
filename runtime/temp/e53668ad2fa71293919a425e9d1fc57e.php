<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:64:"C:\wamp64\www\public/../application/admin\view\config\index.html";i:1558175186;s:53:"C:\wamp64\www\application\admin\view\common\head.html";i:1654616318;s:53:"C:\wamp64\www\application\admin\view\common\foot.html";i:1558175186;}*/ ?>
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
    	 <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class="layui-this">基础设置</li>
                <li>SEO管理</li>
                <li>验证码</li>
                <li>上传设置</li>
                <li>接口设置</li>
            </ul>
            <div class="layui-tab-content" >
                <div class="layui-tab-item layui-show"><br>
                    <div class="layui-anim layui-anim-up">
                        <form class="layui-form layui-card-body layui-card-bodys" lay-filter="form-system">
                            <div class="layui-form-item">
                                <label class="layui-form-label">应用名</label>
                                <div class="layui-input-4">
                                    <input type="text" name="name" lay-verify="required" placeholder="请输入网站名称" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">客户端域名</label>
                                <div class="layui-input-4">
                                    <input type="text" name="url" lay-verify="url" placeholder="请输入网站地址" class="layui-input">
                                </div>
                            </div>
                         
                            <div class="layui-form-item">
                                <label class="layui-form-label">网站LOGO</label>
                                <input type="hidden" name="logo" id="logo">
                                <div class="layui-input-block">
                                    <div class="layui-upload">
                                        <button type="button" class="layui-btn layui-btns layui-btn-blue" id="logoBtn"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;点击上传</button>
                                        <div class="layer-photos-demo layui-upload-list" id="layer-photos-demo">
                                            <img class="layui-upload-img" id="logos" style="border-radius: 50%;width: 110px;height: 110px;">
                                            <p id="demoText"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item" style="display: none;" id="jin">
                              <label class="layui-form-label"></label>
                              <div class="layui-input-4" style="width:140px;">
                                  <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="progressBar">
                                      <div class="layui-progress-bar layui-btn-blue" lay-percent="0%"></div>
                                  </div>
                              </div>
                            </div>
                          <!--   <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">QQ群二维码</label>
                                <div class="layui-input-block">
                                    <textarea name="qq" lay-verify="qq" placeholder="请输入QQ群二维码" class="layui-textarea"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">自动关注公众号</label>
                                <div class="layui-input-block">
                                    <textarea name="focus" lay-verify="focus" placeholder="请输入自动关注公众号" class="layui-textarea"></textarea>
                                    <div class="layui-form-mid layui-word-aux">
                                        <span style="color: red">*</span>用逗号进行分割
                                    </div>
                                </div>
                            </div> -->
                            <div class="layui-form-item">
                                <label class="layui-form-label">网站状态</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="statu" value="open" title="开启">
                                    <input type="radio" name="statu" value="close" title="关闭">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">分页数量</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="limit" lay-verify="limit" placeholder="请输入分页数量" class="layui-input">
                                    <div class="layui-form-mid layui-word-aux">
                                        <span style="color: red">*</span> 分页显示条数
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">备案号</label>
                                <div class="layui-input-3">
                                    <input type="text" name="bah" placeholder="请输入备案号" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">Copyright</label>
                                <div class="layui-input-3">
                                    <input type="text" name="copyright" placeholder="请输入Copyright" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">公司地址</label>
                                <div class="layui-input-3">
                                    <input type="text" name="ads" placeholder="请输入公司地址" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">联系电话</label>
                                <div class="layui-input-3">
                                    <input type="text" name="tel" placeholder="请输入联系电话" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">邮箱账号</label>
                                <div class="layui-input-3">
                                    <input type="text" name="email" placeholder="请输入邮箱账号" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="sys">提交</button>
                                    <button type="reset" class="layui-btn layui-btns layui-btns layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="layui-tab-item"><br>
                    <div class="layui-anim layui-anim-up">
                        <form class="layui-form" lay-filter="form-system">
                            <div class="layui-form-item">
                                <label class="layui-form-label">SEO标题</label>
                                <div class="layui-input-4">
                                    <input type="text" name="title" lay-verify="required" placeholder="请输入SEO标题" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">SEO关键字</label>
                                <div class="layui-input-block">
                                    <textarea name="key" lay-verify="required" placeholder="请输入SEO关键字" class="layui-textarea"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item layui-form-text">
                                <label class="layui-form-label">SEO描述</label>
                                <div class="layui-input-block">
                                    <textarea name="des" lay-verify="required" placeholder="请输入SEO描述" class="layui-textarea"></textarea>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="sys">提交</button>
                                    <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="layui-tab-item"><br>
                    <div class="layui-anim layui-anim-up">
                        <form class="layui-form" lay-filter="form-system">
                            <div class="layui-form-item">
                                <label class="layui-form-label">用户登录</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="usercode" value="open" title="开启">
                                    <input type="radio" name="usercode" value="close" title="关闭">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">管理员登录</label>
                                <div class="layui-input-block">
                                    <input type="radio" name="code" value="open" title="开启">
                                    <input type="radio" name="code" value="close" title="关闭">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="sys">提交</button>
                                    <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="layui-tab-item"><br>
                    <div class="layui-anim layui-anim-up">
                        <form class="layui-form" lay-filter="form-system">
                            <div class="layui-form-item">
                                <label class="layui-form-label">上传大小</label>
                                <div class="layui-input-3">
                                    <input type="text" name="uploadsize" placeholder="请输入上传大小" class="layui-input"  lay-verify="size" id="uploadsize">
                                    <div class="layui-form-mid layui-word-aux">
                                            <span style="color: red">*</span> 设置文件最大可允许上传的大小，单位 KB。不支持ie8/9
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">图片类型</label>
                                <div class="layui-input-3">
                                    <input type="text" name="uploadimgtype" placeholder="请输入上传图片类型" class="layui-input"  lay-verify="uploadtype">
                                    <div class="layui-form-mid layui-word-aux">
                                            <span style="color: red">*</span>  jpg|png|jpeg 即代表只允许上传压缩格式的文件
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">文件类型</label>
                                <div class="layui-input-3">
                                    <input type="text" name="uploadfiletype" placeholder="请输入上传大小" class="layui-input">
                                    <div class="layui-form-mid layui-word-aux">
                                            <span style="color: red">*</span> doc|pdf|xls 即代表只允许上传压缩格式的文件
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">视频类型</label>
                                <div class="layui-input-3">
                                    <input type="text" name="uploadvideotype" placeholder="请输入上传大小" class="layui-input">
                                    <div class="layui-form-mid layui-word-aux">
                                            <span style="color: red">*</span> avi|rmvb|flv 即代表只允许上传压缩格式的文件
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">音频类型</label>
                                <div class="layui-input-3">
                                    <input type="text" name="uploadaudiotype" placeholder="请输入上传大小" class="layui-input">
                                    <div class="layui-form-mid layui-word-aux">
                                            <span style="color: red">*</span> mp3|aac|opus 即代表只允许上传压缩格式的文件
                                    </div> 
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="sys" id="upload">提交</button>
                                    <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="layui-tab-item"><br>
                    <div class="layui-anim layui-anim-up">
                        <form class="layui-form" lay-filter="form-system">
                            <div class="layui-form-item">
                                <label class="layui-form-label">appkey</label>
                                <div class="layui-input-3">
                                    <input type="text" name="apiappkey" placeholder="请输入appkey" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">接口地址</label>
                                <div class="layui-input-3">
                                    <input type="text" name="apiurl" placeholder="请输入接口地址" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button type="button" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="sys">提交</button>
                                    <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
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
<script>
var url = '<?php echo url("edit"); ?>';
layui.use(['form','layer','upload','element'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,upload = layui.upload
    ,element = layui.element
    ,$ = layui.jquery;

    //自定义验证规则
  /*  form.verify({
        uploadsize: [/^\+?[1-9][0-9]*$/, '请输入大于或等于0整数'],
    });*/
    var seytem = <?php echo $system; ?>;
    form.val("form-system", seytem);
    $('#logos').attr('src',"/public"+seytem.logo);
    layer.photos({
        photos: '#layer-photos-demo'
        ,anim: 3 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    });
    //普通图片上传
    var uploadInst = upload.render({
        elem: '#logoBtn'
        ,url: '<?php echo url("Upfiles/upimages"); ?>'
        ,accept: 'images'
        ,before: function(obj){
            //预读本地文件示例，不支持ie8
            this.data={files:'logo'};//关键代码
           // obj.preview(function(index, file, result){
               // $('#logos').attr('src', result); //图片链接（base64）
               // $("#logos").css({"width":110+"px","height":110+"px"});
           // });
        }
        ,progress: function(e , percent) {
            $("#jin").show();
            element.progress('progressBar',percent  + '%');
        }
        ,done: function(res){
            //上传成功
            if(res.code>0){
                $('#logos').show();
                $('#logos').attr('src', '/public'+res.src); //图片链接（base64）
                $("#logos").css({"width":110+"px","height":110+"px"});
                $('#logo').val(res.src);
            }else{
                //如果上传失败
                $("#jin").hide();
                layer.msg('上传失败');
                return false;
            }
        }
        ,error: function(){
            //演示失败状态，并实现重传
            $("#jin").hide();
            layer.msg('上传失败');
            return false;
        } 
    });

    $('#upload').click(function(){
        var uploadsize = $('#uploadsize').val();
        if(!(/^\+?[1-9][0-9]*$/).test(uploadsize)){
            $("#uploadsize").css("border","1px solid red");
            layer.msg("上传大小请输入大于或等于0整数");
            return false;
        }
    })

    //自定义验证规则
    form.verify({
        limit: function(value){
            var limits = value%10;
            if(limits && (value < 0 || limits != 0)){
                return '分页数量格式错误,请输入10的倍数';
            }
        }
    });

    //监听提交
    form.on('submit(sys)', function(data){
        loading =layer.load(1, {shade: [0.1,'#fff']});
        $.post(url,data.field,function(res){
            layer.close(loading);
            if(res.code == 1){
                layer.msg(res.msg,function () { 
                    window.location.href = res.url;
                });
            }else if(res.code == 0){
                layer.msg(res.msg); 
           }else{
                layer.msg('你无操作权限！'); 
           }
        },'json')
        return false;
    }); 
});
</script>