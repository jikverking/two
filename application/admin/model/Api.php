<?php
namespace app\admin\model;
use think\Model;
class Api extends Model
{   
	//柠檬平台获取手机号
    public function nmphone($name,$pwd,$pid,$cuy,$num,$noblack,$serial)
    {
        $url = "http://opapi.lemon91.com/out/ext_api/getMobileCode?name=$name&pwd=$pwd&cuy=$cuy&pid=$pid&num=$num&noblack=$noblack&serial=$serial";
        $data = model('Common')->curl_get($url);
        $data = json_decode($data,true); 
        //成功状态返回
        if($data['code'] == 200){
            $list = $data['data']; 
            $arr = array();
            if(is_array($list)){  
                foreach ($list as $key => $value) {
                   $explode = explode(',', $value);
                }
            }else{
                $explode = explode(',', $list);
            }
            $arr['phones'] = $explode[0];
            $arr['word'] = $explode[1];
            $arr['phone'] = str_replace($arr['word'], '', $arr['phones']);
            $find = strpos($arr['phone'],'+'); 
            if($find === false){
                $arr['phone'] = $arr['phone'];
            }else{
                $ex = explode("+",$arr['phone']);
                $arr['phone'] = $ex[1];
            }
            $data['data'] = $arr;
            return $data;
        }else{
            return $data;
        }
    }

    //易码平台获取手机号
    public function ymphone($tokens,$pid)
    {   
        $url = "http://api.fxhyd.cn/UserInterface.aspx?action=getmobile&token=$tokens&itemid=$pid";
        $data = model('Common')->curl_get($url);
        $data = explode('|',$data);
        return $data;
    }

    
    //柠檬平台获取验证码
    public function nmcode($name,$pwd,$pn,$pid,$serial)
    {
        $url = "http://opapi.lemon91.com/out/ext_api/getMsg?name=$name&pwd=$pwd&pn=$pn&pid=$pid&serial=$serial";
        $data = model('Common')->curl_get($url);
        $data = json_decode($data,true);
        return $data;
    }

    //易码平台获取验证码
    public function ymcode($tokens,$pn,$pid)
    {
        $url = "http://api.fxhyd.cn/UserInterface.aspx?action=getsms&token=$tokens&itemid=$pid&mobile=$pn";
        $data = model('Common')->curl_get($url);
        $data = explode('|',$data);
        return $data;
    }

    //柠檬平台释放手机号码
    public function nmfree($name,$pwd,$pn,$pid,$serial)
    {
        $url = "http://opapi.lemon91.com/out/ext_api/passMobile?name=$name&pwd=$pwd&pn=$pn&pid=$pid&serial=$serial";
        $data = model('Common')->curl_get($url);;
        $data = json_decode($data,true);
        return $data;
    }

    //易码平台释放手机平台
    public function ymfree($tokens,$pn,$pid)
    {
        $url = "http://api.fxhyd.cn/UserInterface.aspx?action=release&token=$tokens&itemid=$pid&mobile=$pn";
        $data = model('Common')->curl_get($url);
        $data = explode('|',$data);
        return $data;
    }

    //柠檬平台手机号码加黑名单
    public function nmaddblack($name,$pwd,$pn,$pid)
    {
        $url = "http://opapi.lemon91.com/out/ext_api/addBlack?name=$name&pwd=$pwd&pn=$pn&pid=$pid";
        $data = model('Common')->curl_get($url);; 
        $data = json_decode($data,true);
        return $data;
    }

    //易码平台手机号码加黑名单
    public function ymaddblack($tokens,$pn,$pid)
    {
        $url = "http://api.fxhyd.cn/UserInterface.aspx?action=addignore&token=$tokens&itemid=$pid&mobile=$pn";
        $data = model('Common')->curl_get($url);
        $data = explode('|',$data);
        return $data;
    }

    //验证码发送成功状态修改
    public function nmupdate($array,$res,$record,$sid)
    {
        $array['sid'] = $sid;
        $array['statu'] = 0; 
        $array['smstime'] = time();
        $array['type'] = 1;
        if(!$res){       
            db('sms')->insert($array);
        }
        $arr['type'] = 0;
        $arr['types'] = 1;
        $arr['getcodetime'] = time();
        db('userrecord')->where('id',$record['id'])->update($arr);
    }

    //短信发送成功状态修改
    public function nmupdates($array,$res,$record,$sid)
    {
        $array['sid'] = $sid;
        $array['statu'] = 0; 
        $array['type'] = 0;
        $array['smstime'] = time();
        if(!$res){       
            db('sms')->insert($array);
        }
        $arr['type'] = 0;
        $arr['types'] = 0;
        $arr['getcodetime'] = time();
        db('userrecord')->where('id',$record['id'])->update($arr);
    }

    //易码平台发送短信
    public function ymsend($tokens,$pn,$pid,$sms,$number)
    {
    	$url = "http://api.fxhyd.cn/UserInterface.aspx?action=sendsms&token=$tokens&itemid=$pid&mobile=$pn&sms=$sms&number=$number";
        $data = model('Common')->curl_get($url);
        $data = explode('|',$data);
        return $data;
    }
}