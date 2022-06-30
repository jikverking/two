<?php
namespace app\admin\controller;
use think\Request;
use think\Controller;
class Common extends Controller
{
	protected $HrefId,$adminRules;
	public function _initialize(){	
		date_default_timezone_set('PRC'); //设置中国时区 
	    //判断管理员是否登录
	    if(!session('adminid')) {
	    	$this->redirect('admin/login/index');
	    }
	    //配置信息
       /* $configs = db('config')->field('name,value')->select();
        $configinfo = array();
        foreach ($configs as $key => $value) {
            $configinfo[$value['name']] = $value['value'];
        }*/
        $configinfo = configs();
        $this->assign('configinfo', $configinfo);

        define('MODULE_NAME',strtolower(request()->controller()));
        define('ACTION_NAME',strtolower(request()->action()));
        //权限管理
        //当前操作权限ID
        if(session('adminid')!=1){
            $this->HrefId = db('auth_rule')->where('href',MODULE_NAME.'/'.ACTION_NAME)->value('id');
            //当前管理员权限
            $map['a.adminid'] = session('adminid');
            $rules = db('admin')
                ->alias('a')
                ->join('auth_group ag','a.group_id = ag.group_id','left')
                ->where($map)
                ->value('ag.rules');
            $this->adminRules = explode(',',$rules);
            if($this->HrefId){
                if(!in_array($this->HrefId,$this->adminRules)){
                    $this->redirect('index/no');
                }
            }
        }

        $authRule = db('auth_rule')->where('menustatus=1')->order('sort asc,title desc')->select();
        //声明数组
        $menus = array();
        foreach ($authRule as $key=>$val){
            $authRule[$key]['href'] = url($val['href']);
            if($val['pid']==0){
                if(session('adminid')!=1){
                    if(in_array($val['id'],$this->adminRules)){
                        $menus[] = $val;
                    }
                }else{
                    $menus[] = $val;
                }
            }
        }
        foreach ($menus as $k=>$v){
            foreach ($authRule as $kk=>$vv){
                if($v['id']==$vv['pid']){
                    if(session('adminid')!=1) {
                        if (in_array($vv['id'], $this->adminRules)) {
                            $menus[$k]['children'][] = $vv;
                        }
                    }else{
                        $menus[$k]['children'][] = $vv;
                    }
                }
            }
        }

        $urlhrefs = request()->controller();
        $urlhref = strtolower(request()->controller()).'/'.strtolower(request()->action());
        $urlhref = $urlhref.'.html';
        $admininfo = db('admin')->field('avatar,loginnum,tel,logintime')->where('adminid',session('adminid'))->find();
        $authruleinfo = typeinfo();
        $this->assign('url', $urlhref);
        $this->assign('urls', $urlhrefs);
        $this->assign('admininfo', $admininfo);
        $this->assign('authruleinfo', $authruleinfo);
        $this->assign('menus', $menus);
	}

	//空操作
    public function _empty(){
        return $this->fetch('public/404');
    }

}
