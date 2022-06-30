<?php
namespace app\admin\controller;
use clt\Leftnav;
class Order extends Common
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
    public function orderadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $hyid=$data['isnot_vip'];
            $get_vip_tel = db('vip')->where('hyid',$hyid)->find();
           // dump($get_vip_tel);die;
//判定vip账户
//余额是否足够
if ($get_vip_tel) 
{
  
$isnot_zf=$get_vip_tel['money']-$data['zh'];
  if ($isnot_zf>=0) 
  {
    //账户有钱可以抵扣下单
                //账户余额够抵扣进行下单
            $data['add_time']=date("Y-m-d H:i:s");

            $data['tel']=$get_vip_tel['tel'] ;
              //  dump($get_vip_tel);die;
            $data['add_time_sjc']=strtotime( $data['add_time']);
                  //  dump($data);die;
            $insert = db('order')->insert($data);
                

           // $insert = db('user')->insert($data);
            if($insert)
            {
                //会员下单成功从会员子账户扣除金额
 db('vip')->where('tel',$get_vip_tel['tel']) ->update(['money'=>$isnot_zf]);

                adminlog();
                return json(['code'=>1,'msg'=>'添加订单成功']);
            }
            else
            {
                return json(['code'=>0,'msg'=>'添加失败']);
            }


  } 
  else 
  {
    //账户钱不够请充值
    
   return json(['code'=>0,'msg'=>'余额不足请充值']);
  }


  // dump($data['zh']);die;
} 
else 
{
    //非会员下单
  //dump(222);die;
 $data['add_time']=date("Y-m-d H:i:s");
            $data['tel']=$get_vip_tel['tel'] ;
            $data['add_time_sjc']=strtotime( $data['add_time']);
                  //  dump($data);die;
            $insert = db('order')->insert($data);
            if($insert)
            {
                adminlog();
                return json(['code'=>1,'msg'=>'添加订单成功']);
            }
            else
            {
                return json(['code'=>0,'msg'=>'添加失败']);
            }
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

    public function order_del(){
                if(request() ->isPost()){

            $id = $_POST['id'];
                        //单条记录删除
                 $order_res= db('order')->where('order_id',$id)->find();

                $del = db('order')->where('order_id',$id)->delete();
                //dump($del);die;
                if($del){
                    //删除后吧vip资金还回来
  
      
            $get_vip_tel = db('vip')->where('hyid',$order_res['isnot_vip'])->find();
$vip_zh=$get_vip_tel['money']+$order_res['zh'];


 db('vip')->where('hyid',$order_res['isnot_vip']) ->update(['money'=>$vip_zh]);
// dump($order_res);die;

                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }
    }

    //     public function order_del(){
    //             if(request() ->isPost()){

    //         $id = $_POST['id'];
    //                     //单条记录删除
    //             $del = db('order')->where('order_id',$id)->delete();
    //                // $order_res= db('order')->where('order_id',$id)->find();

    //   //  dump($order_res);die;
    //         //$get_vip_tel = db('vip')->where('hyid',$hyid)->find();
    // //dump($del);die;
    //             if($del){
    //                 //删除后吧vip资金还回账户里
    //    // $order_res= db('order')->where('order_id',$id)->find();

    //   //  dump($order_res);die;
    //         //$get_vip_tel = db('vip')->where('hyid',$hyid)->find();

    //                 adminlog()
    //                 return json(['code'=>1,'msg'=>'删除成功']);
    //             }else{
    //                 return json(['code'=>0,'msg'=>'删除失败']);
    //             }
    //         }
    // }

   }        