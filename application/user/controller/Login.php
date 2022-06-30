<?php
namespace app\user\controller;
use think\Controller;
use location;
class Login extends Controller
{

    public function _initialize(){
        //配置信息
        $config = configs('user');
        $this->assign('config', $config);
    }

    //用户登录验证
    public function index()
    {
        if(request() -> isPost()){
            $username = trim(input('post.username'));
            $password = trim(input('post.password'));
            $user = db('user')
                -> field('id,username,password,loginip,ipadress,logintime,loginnum,salt,statu,endtime')
                ->where('username',$username)
                ->find();
            if(!$user){
                return json(['code' => 0, 'msg' => '用户名错误']);
            }
            //密码验证
            $passwords = md5(md5($password).$user['salt']);
            if($user['password'] != $passwords){
                return json(['code' => 0, 'msg' => '密码错误']);
            }
            //配置信息
            $config = configs('user');
            //验证码验证
            if($config['usercode'] == 'open'){
                $code = trim(input('post.captcha'));
                if(!$this->check($code)){
                    return json(array('code' => 0, 'msg' => '验证码错误'));
                }
            }
            $time = time();
            if($user['id'] != 1){
                //账号验证
                if($user['statu'] != 1){
                    return json(array('code' => 0, 'msg' => '账号已经禁封'));
                }
                if($time > $user['endtime']){
                    return json(array('code' => 0, 'msg' => '账号已经到期'));
                }
            }
            session('userid',$user['id']);
            session('usernames',$user['username']);
            session('loginips',$user['loginip']);
            session('ipadresss',$user['ipadress']);
            session('logintimes',$user['logintime']);
            $remember = input('post.remember');
            $remember=isset($remember) ? $remember : ' ';
            if(isset($remember) && $remember==1){
                cookie('username',trim($username),60*60*24*7);
                cookie('password',trim($password),60*60*24*7);
                cookie('remember',$remember,60*60*24*7);
            }
            $arr['loginip'] = request()->ip();
            $location = new location\IpLocation();
            $ips = $location->getlocation($arr['loginip']);
            $arr['ipadress'] = $ips['country'];
            $arr['logintime'] = time();
            $arr['loginnum'] = $user['loginnum']+1;
            db('user')->where('username',$user['username'])->setField($arr);
            return json(['code' => 1, 'msg' => '登录成功!','url' => url('index/index')]);
        }else{
            $username=isset($_COOKIE["username"]) ? $_COOKIE["username"] : "";
            $password=isset($_COOKIE["password"]) ? $_COOKIE["password"] : "";
            $remb=isset($_COOKIE["remember"]) ? $_COOKIE["remember"] : "sfd";
            $this->assign('remb',$remb);
            $this->assign('username',$username);
            $this->assign('password',$password);
            return $this->fetch();
        }
    }

    //授权登录
    public function indexs()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $user = db('user')
                -> field('id,username,loginip,ipadress,logintime,loginnum,statu,endtime')
                -> where('id',$id)
                -> find();
            if(!$user){
                return json(['code' => 0, 'msg' => '账号不存在!']);
            }
            $time = time();
            if($user['id'] != 1){
                //账号验证
                if($user['statu'] != 1){
                    return json(array('code' => 0, 'msg' => '账号已经禁封'));
                }
                if($time > $user['endtime']){
                    return json(array('code' => 0, 'msg' => '账号已经到期'));
                }
            }
            session('userid',$user['id']);
            session('usernames',$user['username']);
            session('loginips',$user['loginip']);
            session('ipadresss',$user['ipadress']);
            session('logintimes',$user['logintime']);
            $arr['loginip'] = request()->ip();
            $location = new location\IpLocation();
            $ips = $location->getlocation($arr['loginip']);
            $arr['ipadress'] = $ips['country'];
            $arr['logintime'] = time();
            $arr['loginnum'] = $user['loginnum']+1;
            db('user')->where('username',$user['username'])->setField($arr);
            return json(['code' => 1, 'msg' => '授权登陆成功!']);
        }
    }

    public function check($code){
        return captcha_check($code);
    }

    //后台管理用户退出
    public function loginout()
    {
        // 清除session (当前作用域)
        /*session(null);*/
        session('userid', null);
        session('username', null);
        $this->redirect('user/login/index');
    }

    //空操作
    public function _empty(){
        return $this->fetch('public/404');
    }
}