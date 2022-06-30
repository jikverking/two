<?php
namespace app\user\controller;
class User extends Common
{
    /**
     * 用户管理
     */

    /**
     * 编辑用户信息
     */
    public function useredit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['endtime'] = strtotime($data['endtime']);
            $sql = db('user')->field('password')->where('id',$id)->find();
            $infos = db('user')->where('username',$data['username'])->find();
            $res = db('user')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            if($infos['id'] != $id && $infos['username'] == $data['username']){
                return json(['code'=>0,'msg'=>'用户名已经存在']);
            }
            $data['appkey'] = md5(md5($data['username']).$sql['password']);
            $insert = db('user')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('user')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 修改用户密码
     */
    public function editpass()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = array();
            $password = input('post.password');
            $users = db('user')->field('salt,password')->where('id',$id)->find();
            $md5 = md5(md5($password).$users['salt']);
            $data['id'] = $id;
            $data['password'] = $md5;
            $sql = db('user')->field('username')->where('id',$id)->find();
            $data['appkey'] = md5(md5($sql['username']).$data['password']);
            $count = db('user')->where($data)->find();
            if($count){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $update = db('user')->where('id', $id)->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            return $this->fetch();
        }
    }
}