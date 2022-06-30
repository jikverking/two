<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:66:"C:\wamp64\www\public/../application/admin\view\order\orderadd.html";i:1654777188;s:55:"C:\wamp64\www\application\admin\view\common\header.html";i:1558175186;s:55:"C:\wamp64\www\application\admin\view\common\footer.html";i:1558175186;}*/ ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-2.1.4.min.js"></script>
 <script type="text/javascript" src="/public/static/common/layui/xm-select.js"></script>
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


    <label class="layui-form-label">跟单师傅</label>
    <div class="layui-input-block">
      <select  name="sf_name" lay-verify="required">
        <option value=""></option>
        <option value="张三">张三</option>
        <option value="李四">李四</option>

      </select>
    </div>
    </div>



     <div class="layui-form" >
   <div class="layui-form-item">
        <label class="layui-form-label">消费项目</label>
         <div class="layui-input-block">
           <div id="demo1" style="width: 300px"></div>
         </div>
   </div>
 </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">原价</label>
                        <div class="layui-input-4">
                            <input type="text" id="yuanjia" name="yuanjia" autocomplete="off" placeholder="应付金额" class="layui-input">
                        </div>
                    </div>
                        <label class="layui-form-label">vip账号</label>
                        <div class="layui-input-4">
                            <input type="text" name="isnot_vip" id="scselect" autocomplete="off" placeholder="请输入手机号" onclick="dddh()" class="layui-input">
                          <!--   <div class="layui-form-mid layui-word-aux">
                                <span style="color: red">*</span> 用户名格式为4到16位（字母，数字，下划线，减号）
                            </div> -->
                        </div>
                    </div>



 <div class="layui-col-md6">
            <div class="layui-card">
  
               <div class="layui-input-4">
  <div id="tzselect"></div>
                </div>
            </div>
        </div>


                    <div class="layui-form-item">
                        <label class="layui-form-label">享受折扣</label>
                        <div class="layui-input-4">
                            <input type="text" id="zk" name="zk" autocomplete="off" placeholder="享受折扣" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">会员价格</label>
                        <div class="layui-input-4">
                            <input type="text" id="zh" name="zh" autocomplete="off" placeholder="享受折扣" class="layui-input">
                        </div>
                    </div>
 <input type="hidden" id="vip_id" name="isnot_vip" autocomplete="off" placeholder="会员ID" class="layui-input">
                  <!--        <div id="tzselect"></div>
                         <div id="list"></div> -->


  


                    <div class="layui-form-item">
                        <label class="layui-form-label">付款时间</label>
                        <div class="layui-input-4">
                            <input type="text" name="fk_time" autocomplete="off"  class="layui-input" id="endtime">
                        </div>
                    </div>




                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn layui-btns layui-btn-blue" lay-submit="" lay-filter="useradd">添加</button>
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

<script>
    var url = '<?php echo url("orderadd"); ?>';
    layui.use(['form','layer','laydate'], function(){
        var form = layui.form
            ,layer = layui.layer
            ,laydate = layui.laydate
            ,$ = layui.jquery;

        laydate.render({
            elem: '#endtime',
             trigger: 'click' //添加这一行来处理
            ,theme: '#4476A7'
            ,value: '<?php echo date("Y-m-d",strtotime("+1 day")); ?>'
            ,min: 0
        });

        //监听提交
        form.on('submit(useradd)', function(data){

            // var username = $.trim(data.field.username);
            // if(!(/^[a-zA-Z0-9_-]{4,16}$/).test(username)){
            //     layer.msg("请输入正确的用户名格式");
            //     return false;
            // };

            // var phone = $.trim(data.field.phone);
            // if(!(/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/).test(phone)){
            //     layer.msg("请输入正确的手机号码格式");
            //     return false;
            // };

            // var password = $.trim(data.field.password);
            // if(!(/^[a-zA-Z0-9_-]{6,16}$/).test(password)){
            //     layer.msg("请输入正确的密码格式");
            //     return false;
            // };
 console.log(999);
            $.post(url,data.field,function(res){

                 console.log(888);
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


<script>

   

function dddh(){
   var input_dh = $("#scselect").val();
 // var yuanjia = $("#yuanjia").val();
 //   console.log(yuanjia);
     $("#expandabledatatable").remove();
     $("#expandabledatatables").remove();
     // <input type="submit" class="btn btn-primary btn-block" value="提交">
//console.log($date);
      $.ajax({  


          type: "post",  
          url: "<?php echo url('dddh_ajax'); ?>",
          data:{
            input_dh:input_dh,
          
          },
         success: function(result) {

var strVar = "";


    strVar += "<div class=\"layui-col-md6\">\n";
    strVar += "  <div class=\"layui-card\">\n";
    strVar += "    <div class=\"layui-card-body\">\n";
    strVar += "      <table id=\"tableid\" class=\"layui-table\" lay-even lay-skin=\"row\">\n";
    strVar += "        <tbody>\n";
    strVar += "          <tr>\n";
    strVar += "            <th>会员账号<\/th>\n";
    strVar += "            <td>会员金额<\/td>\n";
    strVar += "            <th>会员折扣<\/th>\n";
    strVar += "            <td>会员上次消费时间<\/td>\n";
    strVar += "          <\/tr>\n";
    strVar += "\n";
 for (var i = 0; i < result.length; i++) {

    strVar += "<tr>\n";
    strVar += " <th  id="+result[i].hyid+"  onclick=\"tuizhilist(this)\">\n";

    strVar += ""+  (result[i].tel ? result[i].tel : '') +"\n";;

    strVar += " <\/th>\n";
    strVar += " <th>\n";
    strVar += ""+ (result[i].money   ? result[i].money : '') +"\n";    
    strVar += " <\/th>\n";
    strVar += " <th>\n";
    strVar += ""+ (result[i].discount   ? result[i].discount : '') +"\n";    
    strVar += " <\/th>\n";
    strVar += " <th>\n";
    strVar += ""+ (result[i].date   ? result[i].date : '') +"\n";    
    strVar += " <\/th>\n";

    strVar += "          <\/tr>\n";

}


    strVar += "        <\/tbody>\n";
    strVar += "      <\/table>\n";
    strVar += "    <\/div>\n";
    strVar += "  <\/div>\n";
    strVar += "<\/div>\n";
    strVar += "\n";



             $("#tzselect").html(strVar);
             // location.reload();
             console.log(result);
          }
      });

}

function tuizhilist(trObj)
{
   //var DDDH_ID = $("#DDDH_ID").val();
// var val=$(this).attr("id");
    //  var obj = $(e.target);
//var DDDH_ID = $(this).val();
 //  var DDDH_ID = $("#DDDH_ID").val();
    var DDDH_ID = trObj.id
     var yuanjia = $("#yuanjia").val();
  
  console.log(DDDH_ID);
   $.ajax({  
          type: "post",  
          url: "<?php echo url('orderlist'); ?>",
          data:{DDDH_ID:DDDH_ID},

          data:{"DDDH_ID":DDDH_ID,"yuanjia":yuanjia},
         success: function(result) 
         {
           // console.log(result);
           // 
           // 
           //  var  dataobj = JSON.parse(http_request.response);
            console.log(result);
 $("#scselect").val(result.tel);

 $("#zh").val(result.zhehoujia);
 $("#vip_id").val(DDDH_ID);



  $("#zk").val(result.discount);
    $("#tableid").hide();

         }
      });
}

    function details(trObj)
    {
     var Jobid = trObj.id
      //alert(trObj.id);


   


//  if($("#expandabledatatables").length>0){
//  $("#expandabledatatables").hide();
// }else{
  $.ajax({  
            type: "post",  
            url: "<?php echo url('Shengchan/details'); ?>",
            data:{Jobid:Jobid},
           success: function(result) 
           {
             var strVar = "";
            for (var i = 0; i < result.length; i++) 
            {
                //  strVar += "<table class=\"table table-striped table-bordered table-hover dataTable no-footer\" id=\"expandabledatatable\">\n";
                // strVar += "tbody style=\" background-color: red;\"";
                  strVar += "<tr style=\"background-color:#427fed;\" onclick=\"detaxxils(this)\"  style=\"\">\n";
                  strVar += " <th>\n";
                   strVar += ""+result[i].flname+"进度"+"\n";
                  strVar += " <\/th>\n";
                  strVar += " <th style=\"background-color: #adc7f7;\">\n";
                  strVar += ""+result[i].jindu[0].gxname+"\n";
                  strVar += " <\/th>\n";
                  strVar += " <th>\n";
                  strVar += " 预计完成\n";
                  strVar += " <th style=\"background-color: #adc7f7;\">\n";
                  strVar += ""+result[i].cycles+"\n";
                  strVar += "   <\/th>\n";
                  strVar += "<input type=\"hidden\" id=\"Jobid\" class=\"btn btn-primary btn-block\" value="+result[i].Jobid+">\n";
                  strVar += " <\/tr>\n";
                  strVar += " <tr style=\"font-size: 0.5rem;\">\n";
                  strVar += "<\/tr>\n";
                //  strVar += "<\/table>\n";
            }
            strVar += "\n";
        
 $(trObj.parentElement).append(strVar);

//$(trObj).after(strVar); 
           // $(trObj).after("<tr onclick='details(this)'><td>这是新行</td><td></td><tr/>"); 
           }
         });
//}
    

    }









 $('#one').on('input', function() {
   function createLink(){
    if(window.ActiveXObject){
        var newRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        var newRequest = new XMLHttpRequest();
    }
    return newRequest;
   }
      http_request = createLink();//创建一个ajax对象
    if ($("#one").val()) {
         if(http_request){
                var one = $("#one").val(); 
             console.log(one);
                    var url = "<?php echo url('getname'); ?>";
                    var data = "one="+one;
                    //alert(data)
                    http_request.open("post",url,true);
                    http_request.setRequestHeader("content-type","application/x-www-form-urlencoded");
                    //指定一个函数来处理从服务器返回的结果
                    http_request.onreadystatechange = dealresultrd; //此函数不要括号
                    //发送请求
                    http_request.send(data);
            }
    }      
});


/*回调渲染列表*/
 function dealresultrd(){
    if(http_request.readyState==4)
    {   
        if(http_request.status==200)
        {
  $("#zhebu").show();
         // alert(111);
            //$('#one').val("");//查询一次晴空ippnut的值
            var  dataobj = JSON.parse(http_request.response);
            console.log(dataobj.length);

    var strVar = "";
    strVar += " <div class=\"table-responsive\">\n";
    strVar += "  <table id=\"example1\"\n";
    strVar += " class=\"table table-hover table-striped table-bordered table-condensed display\">\n";
    strVar += " <thead>\n";
    strVar += " <tr>\n";
    // strVar += " <td align=\"center\">编号<\/td>\n";
    // strVar += " <td align=\"center\"><\/td>\n";
    strVar += "<\/tr>\n";
    strVar += "<\/thead>\n";
    strVar += "<tbody>\n";
    for (var i = 0; i < dataobj.length; i++) {
    strVar += "<tr>\n";
   // strVar += "<form action=\"\" role=\"form\" method=\"post\">\n";
    strVar += "<tr onclick=\"taClick(this)\">\n";
    strVar += "<input type=\"hidden\" name=\"CR_fb_dh\" value=\"\">\n";

    strVar += "<td class=\"tdname\">"+dataobj[i].ideatitle+"<\/td>\n";
    }
 
      // strVar += "<button onclick=\"clos()\">111<\/button>\n";


    strVar += "\n";
    strVar += "<div>\n";
    strVar += " <input type=\"submit\" class=\"btn btn-primary btn-block\" onclick=\"clos()\" value=\"关闭查询\">\n";
    strVar += "<\/div>\n";

    strVar += "<\/tbody>\n";
    strVar += "<\/table>\n";
    strVar += "<\/div>\n"; 
 //strVar += "<td class=\"tdname\" onclick=\"clos()\n">"关闭查询\"<\/td>\n";

 // strVar += "<td class=\"tdname\" onclick=\"clos()\n">"关闭查询\"<\/td>\n";
   $("#zhebu").html(strVar);
 

  /*  $("td").on("click",function(e){
   // alert($(e.target).text());
    let lis =$(e.target).text();
});
    let showBox = $("#example1");
    let func1 = function(i){
        showBox.value +=  ',' + i.target.innerText;
    }
    for (i in lis){
        lis[i].onclick = func1;
    }*/

/*点击获取值*/
  /*  $(function(){
        $('#example1').delegate('td','click',function(){
            var tdval = $(this).text();
            tdval += tdval.substring(0, tdval.lastIndexOf(','));
            $("#ones").val(tdval);

           // alert($(this).text());
        });
    });*/

            }
        }
}
function taClick(e){  
   //   alert($(e).find('.tdname').text())
var text=$(e).find('.tdname').text()
    //var text = $("#tjsh").val()  + $(e).find('.tdname').text()+ ','
    // $("#tjsh").val(text)
   window.location.href = 'http://www.guante100.com:8888/GTSH/public/ideamanage/like/name/'+text+'.html';

  }

function del(){
$(" #ones").val("");
$(" #shr").val("");

}
 



function dels(){
$(" #chaosongren").val("");
$(" #shrrd").val("");

}
 
 //  $("#one").blur(function(){
 // //   $("input").css("background-color","red");
 //    $("#zhebu").hide();

 //  });

function clos()
{   $("#zhebu").hide();

}

</script>

<script type="text/javascript">
    var demo1 = xmSelect.render({
        // 这里绑定css选择器
        el: '#demo1',
        name: 'xiagmu',
            theme: {
        color: '#4476A7',
    }, 
        // 渲染的数据
        data: [
        // {name: '洗', value: 1, selected: true, disabled: true},
            {name: '洗', value:'洗' },
            {name: '剪', value:'剪' },
            {name: '吹', value:'吹'},
            {name: '烫', value: '烫'},
            {name: '染', value: '染'},
            {name: '护', value: '护'},
        ],
    })
    
    // 变量, demo1 可以通过API操作
    // 获取选中值, demo1.getValue();
    // 设置选中值, demo1.setValue([{ name: '动态值', value: 999 }])
    // ...
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

.col-xs-7 {
/*
    margin-left: -80%;
*/
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
/*.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    position: relative;
    min-height: 1px;
    padding-right: 5px!important;
    padding-left: 15px;
}*/


/*}*/

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
