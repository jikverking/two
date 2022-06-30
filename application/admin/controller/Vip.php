<?php
namespace app\admin\controller;
use clt\Leftnav;
class Vip extends Common
{
    /**
     * 用户管理
     */

  public function lst()
    {

 return $this->fetch();
    }

    /**
     * 添加用户
     */
    public function vipadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            // $hyid=$data['isnot_vip'];
            // $get_vip_tel = db('vip')->where('hyid',$hyid)->find();
          





//判定vip账户是否已经存在
  $get_vip = db('vip')->where('tel',$data['tel'])->select();         
if (!$get_vip) 
{
            $data['date']=date("Y-m-d H:i:s");
  $data['date_sjc']=strtotime( $data['date']);

           $insert = db('vip')->insert($data);
            if($insert)
            {



                adminlog();
                return json(['code'=>1,'msg'=>'添加VIP成功']);
            }
            else
            {
                return json(['code'=>0,'msg'=>'添加失败']);
            }
}
else
{
     return json(['code'=>0,'msg'=>'已经有了此账号不能重复']);
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




      public function dddh_ajax(){    
    $input_dh = input('input_dh');
    if ($input_dh) {
          $result=db('vip')->where('tel','like',$input_dh.'%')->select();
    } else {
          $result='';
    }


    
 
    //dump($result);die;



   

    return $result;
  }

    public function orderlist()
    {
          $DDDH_ID = input('DDDH_ID');
         // $yuanjia = input('yuanjia');
 $res=$this->request->param();
          $result = db('vip')->where('hyid',$DDDH_ID)->find();

      $result['zhehoujia'] = $res['yuanjia']*$result['discount'];


       //  dump($result);die();
           return $result;
    }   

    public function vip_del(){
                if(request() ->isPost()){

            $id = $_POST['id'];
            //dump($id);die;
                        //单条记录删除
                // $order_res= db('vip')->where('hyid',$id)->find();

                $del = db('vip')->where('hyid',$id)->delete();
                //
                if($del){

// dump($order_res);die;

                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }
    }

    /**
     * 编辑用户信息
     */
    public function vipedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['date'] = date("Y-m-d H:i:s");
      //dump($data);die;



            $update = db('vip')->where('tel',$data['tel'])->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('vip')->where('hyid',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }



   }        