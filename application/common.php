<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//生成数字与英文组成的随机数
function randoma($length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
 
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
 
    return $str;
}

//生成数字与英文组成的随机数
function randoms($length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'));
 
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
 
    return $str;
}

//生成数字与英文组成的随机数
function randomb($length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('A', 'Z'));
 
    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }
 
    return $str;
}

//生成二维码方法一
function createQRcode($url,$flag=0){
    vendor("phpqrcode.phpqrcode");
    // 纠错级别：L、M、Q、H
    $level = 'L';
    // 点的大小：1到10,用于手机端4就可以了
    $size = 5;
    if($flag){
        $path = ROOT_PATH . 'public/qrcode/';
        if(!file_exists($path)){
            mkdir($path, 0700);
        }
        // 生成的文件名
        $fileName = 'qrcode/'.date('YmdHis').'.png';//时间戳命名
        QRcode::png($url, $fileName, $level, $size);
        return $fileName;
    }else{
        QRcode::png($url, false, $level, $size);//不保存，直接显示二维码
        exit;
    }

}

//生成二维码方法二
function createQRcodes($url){
    $qrcode = new \QRcode();
    $value = $url;                    //二维码内容  
    $errorCorrectionLevel = 'H';    //容错级别  
    $matrixPointSize = 6;           //生成图片大小  

    ob_start();
    $qrcode::png($value,false , $errorCorrectionLevel, $matrixPointSize, 2);  
    // $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2); //这里就是把生成的图片流从缓冲区保存到内存对象上，使用base64_encode变成编码字符串，通过json返回给页面。
    $imageString = base64_encode(ob_get_contents()); //关闭缓冲区
    ob_end_clean(); //把生成的base64字符串返回给前端 
    $imageString = 'data:image/png;base64,'.$imageString;
    return $imageString;
}

/*//清除缓存
function rmdirs($dir){
    $dir_arr = scandir($dir);
    foreach($dir_arr as $key=>$val){
        if($val == '.' || $val == '..'){}
        else {
            if(is_dir($dir.'/'.$val))    
            {                            
                if(@rmdir($dir.'/'.$val) == 'true'){}    //去掉@您看看                
                else
                rmdirs($dir.'/'.$val);                    
            }
            else                
            unlink($dir.'/'.$val);
        }
    }
}*/

//清空文件夹函数和清空文件夹后删除空文件夹函数的处理
function deleteDir($Directory){  
    //检查目录是否存在，不存在则退出程序  
    if(is_dir($Directory)){  
        //打开目录  
        $handle = openDir($Directory);  
        //循环遍历目录  
        while(($file_name = readdir($handle))!==false){  
            //文件路径  
            $file_path = $Directory.DIRECTORY_SEPARATOR.$file_name;  
            //如果目录为 . 或 .. 则不执行下面代码  
            if($file_name!="." && $file_name!=".."){  
                //如果是目录  
                if(is_dir($file_path)){  
                    //调用函数本身，递归遍历所有目录和文件  
                    deleteDir($file_path);  
                }else{  
                    //删除文件  
                    unlink($file_path);  
                }  
            }  
        }  
        //关闭文件  
        closedir($handle);  
        //删除目录  
        rmdir($Directory);  
    }  
   
}  

/**
 * 导出excel
 * @param $strTable	表格内容
 * @param $filename 文件名
 */
function downloadExcel($strTable,$filename)
{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=".$filename."_".date('Y-m-d').".xls");
	header('Expires:0');
	header('Pragma:public');
	echo '<html><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.$strTable.'</html>';
}


// 快速文件数据读取和保存 针对简单类型数据 字符串、数组
function F($name,$value='',$path=DATA_PATH) {
    static $_cache = array();
    $filename   =   $path.$name.'.php';
    if('' !== $value) {
        if(is_null($value)) {
            // 删除缓存
            return unlink($filename);
        }else{
            // 缓存数据
            $dir   =  dirname($filename);
            // 目录不存在则创建
            if(!is_dir($dir))  $res=mkdir($dir,0777,true);
            return file_put_contents($filename,"<?php\nreturn ".var_export($value,true).";\n?>");
        }
    }
    if(isset($_cache[$name])) return $_cache[$name];
    // 获取缓存数据
    if(is_file($filename)) {
        $value   =  include $filename;
        $_cache[$name]   =   $value;
    }else{
        $value  =   false;
    }
    return $value;
}
//缓存
function savecache($name = '',$id='') {
    if($name=='Field'){
        if($id){
            $Model = db($name);
            $data = $Model->order('listorder')->where('moduleid='.$id)->column('*', 'field');
            $name=$id.'_'.$name;
            F($name,$data);
        }else{
            $module = F('Module');
            foreach ( $module as $key => $val ) {
                savecache($name,$key);
            }
        }
    }elseif($name=='System'){
        $Model = db ( $name );
        $list = $Model->where(array('id'=>1))->find();
        $data=$sysdata=$list;
        F('System',$list); 
    }elseif($name=='Module'){
        $Model = db ( $name );
        $list = $Model->order('listorder')->select ();
        $pkid = $Model->getPk ();
        $data = array ();
        $smalldata= array();
        foreach ( $list as $key => $val ) {
            $data [$val [$pkid]] = $val;
            $smalldata[$val['name']] =  $val [$pkid];
        }
        F($name,$data);
        F('Mod',$smalldata);
        //savecache
    }else{
        $Model = db ($name);
        $list = $Model->order('listorder')->select ();
        $pkid = $Model->getPk ();
        $data = array ();
        foreach ( $list as $key => $val ) {
            $data [$val [$pkid]] = $val;
        }
        F($name,$data);
    }
}

//系统设置：配置信息
function configs($where = ''){
    $map = [];
    if(!empty($where)){
        $map['type'] = $where;
    }
    $configs = db('config')->where($map)->field('name,value')->select();
    $config = array();
    foreach ($configs as $key => $value) {
        $config[$value['name']] = $value['value'];
    }
    return $config;
}

/**
 * PHP格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') 
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}

//文件单位换算
function byte_format($input, $dec=0)
{
    $prefix_arr = array("B", "KB", "MB", "GB", "TB");
    $value = round($input, $dec);
    $i=0;
    while ($value>1024) {
        $value /= 1024;
        $i++;
    }
    $return_str = round($value, $dec).$prefix_arr[$i];
    return $return_str;
}

//时间日期转换
function toDate($time, $format = 'Y-m-d H:i:s') 
{
    if (empty ( $time )) {
        return '';
    }
    $format = str_replace ( '#', ':', $format );
    return date($format, $time );
}

function dir_list($path, $exts = '', $list= array()) 
{
    $path = dir_path($path);
    $files = glob($path.'*');
    foreach($files as $v) {
        $fileext = fileext($v);
        if (!$exts || preg_match("/\.($exts)/i", $v)) {
            $list[] = $v;
            if (is_dir($v)) {
                $list = dir_list($v, $exts, $list);
            }
        }
    }
    return $list;
}

//生成唯一订单号
function orderid(){
    $order_id_main = date('YmdHis').rand(10000000,99999999); 
    //订单号码主体长度
    $order_id_len = strlen($order_id_main);
    $order_id_sum = 0; 
    for($i=0; $i<$order_id_len; $i++){    
        $order_id_sum += (int)(substr($order_id_main,$i,1));
    }
    //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
    $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
    return $order_id;
}

/*
	*	curl的post提交
	*	$url 					请求地址
	*	$data 					参数
	*/
function curl_post($url,$data,$time = 60)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time);
    $contents = curl_exec($ch);
    if($contents === false){
        return json_encode(['code'=>4400,'msg'=>'请求超时']);
    }else{
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0(compatible;MSIE 5.01;Windows NT 5.0)');
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_AUTOREFERER,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        if(curl_errno($ch)){
        }
        curl_close($ch);
        return $output;
    }

}


/*
*	curl的get提交
*	$url 					请求地址
*/
function curl_get($url,$time=60)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $time);
    $contents = curl_exec($ch);
    if($contents === false){
        return json_encode(['code'=>4400,'msg'=>'请求超时']);
    }else{
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //绕过ssl验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        if(curl_errno($ch)){
            /* write_log(curl_error($ch));*/
        }
        //释放curl句柄
        curl_close($ch);
        return $output;
    }

}

/*
*   记录日志
*   $data                   写入日志的内容                     
*/
function write_log($data)
{
    $file_dir = __DIR__."/log";
    if(!is_dir($file_dir)){
        @mkdir($file_dir,0777);
    }
    $log_file = $file_dir . date('Ymd',time()) . '_all.txt';
    $content = '['. date("Y-m-d H:i:s") .']===>' . $data . "\r\n";
    file_put_contents( $log_file, $content, FILE_APPEND );
}

/**
 * 获取已经过了多久
 * PHP时间转换
 * 刚刚、几分钟前、几小时前
 * 今天昨天前天几天前
 * @param  string $targetTime 时间戳
 * @return string
 */


function gettimess($targetTime){
    // 今天最大时间
    $todayLast   = strtotime(date('Y-m-d 23:59:59'));
    $agoTimeTrue = time() - $targetTime;
    $agoTime     = $todayLast - $targetTime;
    $agoDay      = floor($agoTime / 86400);
    if($agoTimeTrue < 60){
        $result['times'] = 1;
        $result['msg'] = '刚刚';
    } elseif ($agoTimeTrue < 3600) {
        $result['times'] = 2;
        $result['msg'] = (ceil($agoTimeTrue / 60)) . '分钟前';
    } elseif ($agoTimeTrue < 3600 * 12) {
        $result['times'] = 3;
        $result['msg'] = (ceil($agoTimeTrue / 3600)) . '小时前';
    }elseif ($agoDay == 0) {
        $result['times'] = 4;
        $result['msg'] = '今天 ' . date('H:i', $targetTime);
       } elseif ($agoDay == 1) {
        $result['times'] = 5;
        $result['msg'] = '昨天 ' . date('H:i', $targetTime);
    } elseif ($agoDay == 2) {
        $result['times'] = 6;
        $result['msg'] = '前天 ' . date('H:i', $targetTime);
    } elseif ($agoDay > 2 && $agoDay < 16) {
        $result['times'] = 7;
        $result['msg'] = $agoDay . '天前 ' . date('H:i', $targetTime);
     } else {
        $format = date('Y') != date('Y', $targetTime) ? "Y-m-d H:i" : "m-d H:i";
        $result['times'] = 8;
        $result['msg'] = date($format, $targetTime);
    }
}

function gettimesss($targetTime){
    // 今天最大时间
    $todayLast   = strtotime(date('Y-m-d 23:59:59'));
    $agoTime     = $todayLast - $targetTime;
    $agoDay      = floor($agoTime / 86400);
    if ($agoDay == 0) {
        $result['times'] = 0;
        $result['msg'] = '今天 ' . date('H:i:s', $targetTime);
    } elseif ($agoDay == 1) {
        $result['times'] = 1;
        $result['msg'] = '昨天 ' . date('H:i:s', $targetTime);
    } elseif ($agoDay == 2) {
        $result['times'] = 2;
        $result['msg'] = '前天 ' . date('H:i:s', $targetTime);
    } elseif ($agoDay > 2 && $agoDay < 16) {
        $result['times'] = $agoDay;
        $result['msg'] = $agoDay . '天前 ' . date('H:i:s', $targetTime);
    } else {
        $format = date('Y') != date('Y', $targetTime) ? "Y-m-d H:i" : "m-d H:i";
        $result['times'] = 16;
        $result['msg'] = date($format, $targetTime);
    }
    return $result;
}

function gettimes($targetTime){
    // 今天最大时间
    $todayLast   = strtotime(date('Y-m-d 23:59:59'));
    $agoTime     = $todayLast - $targetTime;
    $agoDay      = floor($agoTime / 86400);
    if ($agoDay == 0) {
        $result['times'] = 0;
        $result['msg'] = '今天 ' . date('H:i', $targetTime);
    } elseif ($agoDay > 0 && $agoDay < 16) {
        $result['times'] = $agoDay;
        $result['msg'] = $agoDay . '天前 ' . date('H:i', $targetTime);
    } else {
        $format = date('Y') != date('Y', $targetTime) ? "Y-m-d H:i" : "m-d H:i";
        $result['times'] = 16;
        $result['msg'] = date($format, $targetTime);
    }
    return $result;
}

//判断二维数组中是否含有某个值
function issetvalue($datas,$key,$values){
    $lists = [];
    foreach ($datas as $value){
        $lists[] = $value[$key];
    }
    $string = join(',',$lists);
    $find = strpos($string,$values); // $find = 7, 不是
    return $find;
}

function rpushs($redis_name,$incrs){
    $redis = new \Redis();
    $redis->connect('127.0.0.1',6379);
   /* $keys = $redis->keys('*');
    $redis->delete($keys);*/
    $id = $redis->incr($incrs);//$uid自增操作
    $data = [
        'id' => $id,
    ];
    $msginfo = json_encode($data);
    $redis->rPush($redis_name,$msginfo);
    $redis->close();
    dump($msginfo);
}

//删除目录及文件
function dir_delete($dir) {
    $dir = dir_path($dir);
    if (!is_dir($dir)) return FALSE;
    $list = glob($dir.'*');
    foreach($list as $v) {
        is_dir($v) ? dir_delete($v) : @unlink($v);
    }
    return @rmdir($dir);
}

function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if(substr($path, -1) != '/') $path = $path.'/';
    return $path;
}

function substrs($str)
{
    /*$str = "/layuiadmin/public/index.php/admin/wechat/menu.html";*/
    $str = substr($str,strpos($str, '/admin/')+7);
    return $str;
}

function substruser($str)
{
    /*$str = "/layuiadmin/public/index.php/admin/wechat/menu.html";*/
    $str = substr($str,strpos($str, '/user/')+6);
    return $str;
}


//后台用户操作日志 
function adminlog(){
    $module = strtolower(request()->controller());
    $action = strtolower(request()->action());
    $rule = db('auth_rule')->field('id,pid')->where('href',$module.'/'.$action)->find();
    $info = db('auth_rule')->field('id,pid')->where('id',$rule['pid'])->find();
    $pids = db('auth_rule')->field('id')->where('id',$info['pid'])->find();
    $log['aid'] = session('adminid');
    $log['rid'] = $rule['id'];
    $log['pid'] = $info['id'];
    $log['pids'] = $pids['id']; 
    $log['addtime'] = time();
    db('log')->insert($log);
}

//操作类型
function types(){
    $module = strtolower(request()->controller());
    $action = strtolower(request()->action());
    $rule = db('auth_rule')->field('title,pid')->where('href',$module.'/'.$action)->find();
    $info = db('auth_rule')->field('id,pid')->where('id',$rule['pid'])->find();
    $pids = db('auth_rule')->field('id')->where('id',$info['pid'])->find();
    $msg['rd'] = $rule['id'];
    $msg['pid'] = $info['id'];
    $msg['pids'] = $pids['id'];
    return $msg;
}

function typeinfo(){
    $module = strtolower(request()->controller());
    $action = strtolower(request()->action());
    $rule = db('auth_rule')->field('title,pid')->where('href',$module.'/'.$action)->find();
    $info = db('auth_rule')->field('title,pid')->where('id',$rule['pid'])->find();
    $msg['id'] = $rule['title'];
    $msg['pid'] = $info['title'];
    return $msg;
}


//操作类型
function usertypes(){
    $module = strtolower(request()->controller());
    $action = strtolower(request()->action());
    $rule = db('user_auth_rule')->field('title,pid')->where('href',$module.'/'.$action)->find();
    $info = db('user_auth_rule')->field('id,pid')->where('id',$rule['pid'])->find();
    $pids = db('user_auth_rule')->field('id')->where('id',$info['pid'])->find();
    $msg['rd'] = $rule['id'];
    $msg['pid'] = $info['id'];
    $msg['pids'] = $pids['id'];
    return $msg;
}

function usertypeinfo(){
    $module = strtolower(request()->controller());
    $action = strtolower(request()->action());
    $rule = db('user_auth_rule')->field('title,pid')->where('href',$module.'/'.$action)->find();
    $info = db('user_auth_rule')->field('title,pid')->where('id',$rule['pid'])->find();
    $msg['id'] = $rule['title'];
    $msg['pid'] = $info['title'];
    return $msg;
}

//截取文件后缀
function explodes($file)
{
    $str = explode('.',$file);
    $str = array_pop($str);
    return $str;
}


/**
 * @统计一周的数据
 * @$table       表名
 * @$fields      字段名
 *
 */
function counts($table,$fields,$where = ""){
    $map = [];
    if(!empty($where)){
        $map = $map;
    }
    $month = date('Y-m-d',time());
    $semRes = db($table)
        -> field("FROM_UNIXTIME($fields,'%Y-%m-%d') $fields,count(id) count")
        -> where($map)
        -> where("FROM_UNIXTIME($fields,'%Y-%m')",$month)
        -> order($fields.' asc')
        -> group($fields)
        -> select();
    /**
     *原生查询
     */
  /*  $month = date('Y-m',time());
    $prefix = config('database.prefix');
    $semRes = Db::query("select FROM_UNIXTIME(addtime,'%Y-%m-%d') addtime,count(id) count from "
        .$prefix."trill_account WHERE FROM_UNIXTIME(addtime,'%Y-%m') = '".$month."' group by addtime");*/

    // x 轴数据，作为 x 轴标注

    /*
     *  //获取当前月份天数
     * $j = date("t");
     * $start_time = strtotime(date('Y-m-01'));*/  //获取本月第一天时间戳
    /*获取本周数据*/
    $j = 7;
    $start_time = strtotime(date("Y-m-d",strtotime("-6days",time())));
    $xData = array();
    for($i=0;$i<$j;$i++)
    {
        /*$xData[] = date('Y-m-d',$start_time+$i*86400); //每隔一天赋值给数组*/
        $xData[] = date('Y-m-d',$start_time+$i*86400); //每隔一天赋值给数组
    }
    //处理获取到的数据
    $ySemData = array();
    if(!empty($semRes))
    {
        foreach ($xData as $k=>$v)
        {
            foreach ($semRes as $kk=>$vv)
            {
                if($v == $vv[$fields])
                {
                    $ySemData[$k]['count'] = $vv['count'];
                    $ySemData[$k]['time'] =  $xData[$k];
                    /*$ySemData[$k]['time'] =  date('Y/m/d',strtotime($xData[$k]));*/
                    break;
                }else{
                    $ySemData[$k]['count'] = 0;
                    /*$ySemData[$k]['time'] =  date('Y/m/d',strtotime($xData[$k]));*/
                    $ySemData[$k]['time'] =  $xData[$k];
                    continue;
                }
            }
        }
    }else{
        foreach ($xData as $k=>$v)
        {
            $ySemData[$k] = 0;
        }
    }
    return $ySemData;
}

//无限极分类
function getTree($array, $pid=0,$lvl=0)
{
    $tree = '';
    foreach($array as $k => $v)
    {
        if($v['pid'] == $pid)
        { //父亲找到儿子
            if($v['levels'] > 1){
                if($v['href'] == 'Show'){
                    $href = $v['href'];
                }else{
                    $href = url($v['href']);
                }
                $v['href'] = $href;
            }
            $v['lvl']=$lvl + 1;
            $v['children'] = getTree($array, $v['id'],$lvl+1);
            $tree[] = $v;
        }
    }
    return $tree;
}

//生成数字与英文组成的随机数
function random($length)
{
    //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
    $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

    $str = '';
    $arr_len = count($arr);
    for ($i = 0; $i < $length; $i++)
    {
        $rand = mt_rand(0, $arr_len-1);
        $str.=$arr[$rand];
    }

    return $str;
}
