<?php
namespace app\admin\controller;
use clt\Leftnav;
class User extends Common
{
    /**
     * 用户管理
     */


    /**
     * 用户列表信息
     */
    public function userlist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = input('post.key');
            $map['username'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $map['statu'] = $statu;
            }
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            if(!empty($starttime)){
                $map['addtime'] = ['<= time',$starttime];
            }
            if(!empty($endtime)){
                $map['addtime'] = ['<= time',$endtime];
            }
            if(!empty($starttime) && !empty($endtime)){
                $map['addtime'] = ['between time',[$starttime,$endtime]];
            }
           /* if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }*/
            $list = db('user')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                    if($value['id'] == 1){
                        $list['data'][$key]['endtime'] = '时间为无限期';
                    }else{
                        $list['data'][$key]['endtime'] = date('Y-m-d H:i:s',$value['endtime']);
                    }
                    $list['data'][$key]['endtimes'] = $value['endtime'];
                    $list['data'][$key]['nowtime'] = time();
                    if($value['logintime'] == ''){
                        $list['data'][$key]['logintime'] = '';
                    }else{
                        $list['data'][$key]['logintime'] = date('Y-m-d H:i:s',$value['logintime']);
                    }
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'name'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加用户
     */
    public function useradd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $infos = db('user')->where('username',$data['username'])->find();
            if($infos){
                return json(['code'=>0,'msg'=>'用户名已经存在']);
            }
            $data['salt'] = randoma(8);
            $data['password'] = md5(md5($data['password']).$data['salt']);
            $data['appkey'] = md5(md5($data['username']).$data['password']);
            $data['endtime'] = strtotime($data['endtime']);
            $data['addtime'] = time();
            $insert = db('user')->insert($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'添加成功']);
            }else{
                return json(['code'=>0,'msg'=>'添加失败']);
            }
        }else{
            return $this->fetch();
        }
    }

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
           /* if($md5 == $users['password']){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }*/
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

    /**
     * 修改用户状态
     */
    public function userstatu()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            if($id == 1){
                return json(['code'=>0,'msg'=>'你没有修改权限']);
            }
            $statu = input('post.statu');
            $update =db('user')->where('id', $id)->update(['statu' => $statu]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 删除用户信息
     */
    public function userdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if($id == 1){
                return json(['code'=>0,'msg'=>'你没有权限删除']);
            }
            if(is_array($id)){
                //批量删除
                $all = db('user')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('user')->where('id',$id)->delete();
                if($del){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }
        }
    }

    /**
     * 配置规则
     */
    public function groupaccess()
    {
        $nav = new Leftnav();
        $user_rule=db('user_auth_rule')->field('id,pid,title')->order('sort asc,title desc')->select();
        $rules = db('user')->where('id',input('id'))->value('rules');
        $arr = $nav->auth($user_rule,$pid=0,$rules);

        $arr[] = array(
            "id"=>0,
            "pid"=>0,
            "title"=>"全部",
            "open"=>true
        );
        $this->assign('data',json_encode($arr,true));
        return $this->fetch();
    }

    /**
     * 编辑配置权限
     */
    public function groupSetaccess(){
        $rules = input('post.rules');
        if(empty($rules)){
            return array('msg'=>'请选择权限!','code'=>0);
        }
        $data = input('post.');
        $update = db('user')->update($data);
        if($update){
            adminlog();
            return json(['code'=>1,'msg'=>'编辑成功']);
        }else{
            return json(['code'=>0,'msg'=>'编辑失败']);
        }
    }

}