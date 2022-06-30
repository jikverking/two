<?php
namespace app\admin\controller;
use think\Controller;
class Api extends Controller
{
	public function _initialize(){	

	}

	public function index()
    {
    	if(request() -> isPost())
    	{
    		$method  = request() -> method();
	    	$arr = array('GET','POST','PUT','DELETE');
	    	if(!in_array($method,$arr)){
				return json(['code'=>0,'msg'=>"请求方法错误：不支持 ".$method." 请求！"]);
			}
            $time  = request() -> param('time');
		    $tokens      = request() -> header('token');

		    if(!$time){
			    return json(['code'=>0, 'msg'=>"请求参数错误：须包含time参数！"]);
		    }

		    /*if(((time() - $time)>5)){
				return json(['code'=>0, 'msg'=>"请求参数错误：时间戳已经过期！"]);
		    }*/
		    $times = time();
			dump($tokens);
			dump($times);
			dump($_POST);

    	}else{
    		return $this->fetch();
    	}
    }

    public function indexs()
    {
        $url = "http://www.zh.com/openapi/equipment/list";
        $array = [
           'appkey' => 'eb35491f4477994ab201d8cb2b5f980f',
            'limit' => 10,
            'page' => 1,
            'type' => -1,
        ];
        $model = model('Common')->curl_post($url,$array);
        dump($model);
    }

	//获取ID



}