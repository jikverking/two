<?php
namespace app\admin\controller;
class City extends Common
{



    public function index()
    {
        if(session('adminid')!=1){
            $map['a.adminid'] = session('adminid');
            $rules = db('admin')
                ->alias('a')
                ->join('auth_group ag','a.group_id = ag.group_id','left')
                ->where($map)
                ->value('ag.rules');
            $where['menustatus'] = 1;
            $where['id'] = ['in',$rules];
            $arr = db('auth_rule')->where($where)->order('sort')->select();
            $menus = getTree($arr);
        }else{
            $arr = db('auth_rule')->where('menustatus=1')->order('sort')->select();
            $menus = getTree($arr);
        }
        dump($menus);
    }

}