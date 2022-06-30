<?php
namespace  app\user\controller;
class Index extends Common
{
    /**
     * 首页信息
     */
    public function index()
    {
       $user = db('user')
           ->field('loginnum')
           ->where('id',session('userid'))
           ->find();
       //系统信息
       $config = [
           'logintime'       => date('Y-m-d H:i:s',session('logintime')),
           'loginnum'        => $user['loginnum'],
       ];
       //总账号数
        $userid = session('userid');
        if($userid != 1){
            $map['uid'] = $userid;
        }
        $map['tagname'] = ['in',$this->tag];
        $infos['accountcount'] = db('user_account')
            -> where($map)
            -> count();
        $infos['accounttoday'] = db('user_account')
            -> where($map)
            -> whereTime('addtime', 'today')
            -> count();
        //账号管理
        $userid = session('userid');
        if($userid != 1){
            $map['uid'] = $userid;
        }
        $map['tagname'] = ['in',$this->tag];
        $list = counts('user_account','addtime',$map);
        $this->assign('list',$list);
        $this->assign('infos',$infos);
        $this->assign('config',$config);
        return $this->fetch();
    }

    /**
     * 图表信息
     */
    public function chart()
    {
        //账号管理
        $userid = session('userid');
        if($userid != 1){
            $map['uid'] = $userid;
        }
        $map['tagname'] = ['in',$this->tag];
        $list = counts('user_account','addtime',$map);
        dump($list);
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 没有权限
     */
    public function no()
    {
        return $this->fetch('public/no');
    }
}
