<?php
namespace app\admin\controller;
use think\Controller;
use location;
class Login extends Controller
{
    public function _initialize(){ 
        //配置信息
        $config = configs();
        $this->assign('config', $config); 
    }

    //用户登录验证
    public function index()
    {
        if(request() -> isPost()){
            $username = trim(input('post.username'));
            $password = trim(input('post.password'));
            $admin = db('admin')->field('adminid,username,password,loginip,ipadress,logintime,loginnum,salt,is_open')->where('username',$username)->find();
            //用户名验证
            if(!$admin){
                return json(['code' => 0, 'msg' => '用户名错误']);
            }
            //密码验证
            $passwords = md5(md5($password).$admin['salt']);
            if($admin['password'] != $passwords){
                return json(['code' => 0, 'msg' => '密码错误']);
            } 
            //配置信息
            $configs = db('config')->field('name,value')->select();
            $config = array();
            foreach ($configs as $key => $value) {
                $config[$value['name']] = $value['value'];
            }
            //验证码验证
            if($config['code'] == 'open'){     
                $code = trim(input('post.captcha'));
                if(!$this->check($code)){
                    return json(array('code' => 0, 'msg' => '验证码错误'));
                }
            }
            //账号验证
            if($admin['is_open'] != 1){
                return json(array('code' => 0, 'msg' => '账号已经禁封'));
            }
            session('adminid',$admin['adminid']);
            session('username',$admin['username']);
            session('loginip',$admin['loginip']);
            session('ipadress',$admin['ipadress']);
            session('logintime',$admin['logintime']);
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
            $arr['loginnum'] = $admin['loginnum']+1;
            $datas = db('admin')->where('username',$admin['username'])->setField($arr);
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

    public function check($code){
       return captcha_check($code);
    }

    //空操作
    public function _empty(){
        return $this->fetch('public/404');
    }

    //后台管理用户退出
    public function loginout()
    {
        // 清除session (当前作用域)
        /*session(null);*/
        session('adminid', null);
        session('username', null);
        $this->redirect('admin/login/index');
    }
}