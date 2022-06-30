<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:63:"C:\wamp64\www\public/../application/admin\view\vip\vipedit.html";i:1654824215;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-2.1.4.min.js"></script>

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
    <title>管理后台</title>
</head>
<body class="headbody">
 
<div class="fadeInUp animated headalert"><br>
    <div class="layui-anim layui-anim-up">
        <form class="layui-form">
            <div class="layui-container">
                <div class="layui-row">
                    <div class="layui-form-item">




                    <div class="layui-form-item">
                        <label class="layui-form-label">会员手机</label>
                        <div class="layui-input-4">
                            <input type="text" id="tel" name="tel" autocomplete="off" placeholder="手机号码" value="<?php echo $info['tel']; ?>" class="layui-input">
                        </div>
                    </div>
                        <label class="layui-form-label">充值金额</label>
                        <div class="layui-input-4">
                            <input type="text" name="money" id="money" autocomplete="off" placeholder="请输入手机号" value="<?php echo $info['money']; ?>" class="layui-input">
                          <!--   <div class="layui-form-mid layui-word-aux">
                                <span style="color: red">*</span> 用户名格式为4到16位（字母，数字，下划线，减号）
                            </div> -->
                        </div>
                    </div>



 

                    <div class="layui-form-item">
                        <label class="layui-form-label">会员折扣</label>
                        <div class="layui-input-4">
                            <input type="text" id="discount" name="discount" autocomplete="off" placeholder="享受折扣" value="<?php echo $info['discount']; ?>" class="layui-input">
                        </div>
                    </div>



                    <div class="layui-form-item">
                        <label class="layui-form-label">会员密码</label>
                        <div class="layui-input-4">
                            <input type="text" id="mima" name="mima" autocomplete="off" placeholder="会员密码" value="<?php echo $info['mima']; ?>" class="layui-input">
                        </div>
                    </div>



                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="vipedit">修改会员</button>
                            <button type="reset" class="layui-btn layui-btns layui-btn-primary">重置</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
<script src="/public/static/common/layui/layui.js"></script>


<script type="text/javascript">
 var url = '<?php echo url("vipedit"); ?>';
layui.use(['form','layer'], function(){
    var form = layui.form
    ,layer = layui.layer
    ,$ = layui.jquery;
    //监听提交
    form.on('submit(vipedit)', function(data){
        var infos = data.field.tel;
        // if(!(/^[a-zA-Z0-9_-]{6,20}$/).test(infos.password)){
        //     layer.msg("密码请使用6-20位英文，数字及下划线组合");
        //     return false;
        // }

        // if(infos.repassword != infos.password){
        //     layer.msg("两次密码输入不一致");
        //     return false;
        // }
        $.post(url,data.field,function(res){
            if(res.code == 1){
              layer.msg(res.msg);
              setTimeout(function(){
                  window.parent.location.reload();//修改成功后刷新父界面
              }, 1000);
            }else{
              layer.msg(res.msg); 
            }
        },'json')
        return false;
    }); 
});


</script>



　<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            </div>
        </div>
    </div>
<style type="text/css">
.col-xs-3 {
    width: 25%;
}
.orderP{
    margin-left: -120%;
        color: #fff;
}
.funNavBack {
    background: #2dbcd6!important;
    border-radius: 10px;
    margin-bottom: 10px;
    padding: 10px 0 5px;
    color: #fff;
}
p{
    margin:0px !important;
    font-size: 0.1rem;
}

.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
   /* padding-right: 10px !important;
    padding-left: 10px !important;*/
}
.orderPs{
        margin-left: -50%;

}


.funNavBoxx {
  position: absolute;
    background: #fdffff;
    /* margin-bottom: 15px; */
        margin-top: 5px;
            z-index: 999;

}
.funNavBacks {
    background: #439dde!important;
    border-radius: 10px;
    margin-bottom: 10px;
    padding: 10px 0 5px;
    color: #fff;
}
.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 1px solid #ddd;
}
.tdname{
    text-align: center;
}
th{
  width: 25%;
}
xm-select {
    min-height: 36px;
    line-height: 30px;
}
xm-select {
    background-color: #FFF;
    position: relative;
    border: 1px solid #E6E6E6;
    border-radius: 2px;
    display: block;
    width: 125%;
    cursor: pointer;
    outline: none;
}

xm-label-block {
    color: red;
}

#zh{

  color: red;
    font-weight: 900;

}
  
</style>
