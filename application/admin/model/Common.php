<?php
namespace app\admin\model;
use think\Model;
class Common extends Model
{   
	/*
	*	curl的post提交
	*	$url 					请求地址
	*	$data 					参数
	*/
    public function curl_post($url,$data,$time = 60)
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

    /**
     * 模拟post进行url请求
     * @param string $url
     * @param string $param
     */
    public function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }

        $postUrl = $url;
        $curlPost = $param;
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);

        return $data;
    }
    
    /*
	*	curl的get提交
	*	$url 					请求地址
	*/
    public function curl_get($url,$time=60)
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
	*	记录日志
	*	$data 					写入日志的内容 					
	*/
	public function write_log($data)
	{
		$file_dir = __DIR__."/log";
		if(!is_dir($file_dir)){
			@mkdir($file_dir,0777);
		}
		$log_file = $file_dir . date('Ymd',time()) . '_all.txt';
		$content = '['. date("Y-m-d H:i:s") .']===>' . $data . "\r\n";
		file_put_contents( $log_file, $content, FILE_APPEND );
	}


	public function index(){
	    return 1;
    }
}