<?php
namespace  app\user\controller;
use think\Controller;
class Common extends Controller
{
    protected $HrefId,$adminRules,$tag;
    public function _initialize(){
        date_default_timezone_set('PRC'); //设置中国时区
        //判断管理员是否登录
        if(!session('userid')) {
            $this->redirect('user/login/index');
        }
        $configinfo = configs();
        $this->assign('configinfo', $configinfo);
        define('MODULENAME',request()->controller());
        define('MODULE_NAME',strtolower(request()->controller()));
        define('ACTION_NAME',strtolower(request()->action()));
        //权限管理
        //当前操作权限ID
        if(session('userid')!=1) {
            $this->HrefId = db('user_auth_rule')->where('href', MODULE_NAME . '/' . ACTION_NAME)->value('id');
            //当前管理员权限
            $map['id'] = session('userid');
            $rules = db('user')
                ->where($map)
                ->value('rules');
            $this->adminRules = explode(',', $rules);
            if ($this->HrefId) {
                if (!in_array($this->HrefId, $this->adminRules)) {
                    $this->redirect('index/no');
                }
            }
        }
        $where['menustatus'] = 1;
        $map['levels'] = ['egt',3];
        $wheres['levels'] = 3;
        if(session('userid')!=1) {
            $where['id'] = ['in', $rules];
            $wheres['id'] = ['in', $rules];
        }
        $tags = db('user_auth_rule')->field('href')->where($wheres)->order('sort asc,title desc')->select();
        $lists = [];
        foreach ($tags as $key => $value)
        {
            $href = explode('/',$value['href']);
            $lists[] = $href[0];
        }

        $this->tag = join(",",array_unique($lists));
        $arr = db('user_auth_rule')->where($where)->order('sort asc,title desc')->select();
        $menus = getTree($arr);
        $urlhrefs = request()->controller();
        $urlhref = strtolower(request()->controller()).'/'.strtolower(request()->action());
        $urlhref = $urlhref.'.html';
        $userinfo = db('user')->field('loginnum,phone,logintime,appkey')->where('id',session('userid'))->find();
        $authruleinfo = usertypeinfo();
        $this->assign('url', $urlhref);
        $this->assign('urls', $urlhrefs);
        $this->assign('userinfo', $userinfo);
        $this->assign('authruleinfo', $authruleinfo);
        $this->assign('menus', $menus);
    }

    //空操作
    public function _empty(){
        return $this->fetch('public/404');
    }
}
