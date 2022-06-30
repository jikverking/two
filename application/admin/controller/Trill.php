<?php
namespace app\admin\controller;
use think\Db;
class Trill extends Common
{
    /**
     * 抖音管理
     */


    /**
     * 评论管理
     */


    /**
     * 评论列表
     */
    public function commentlist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
            $map['content'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            $id = trim(input('post.id'));
            $count = db('trill_commenting')->field('cid')->where('id',$id)->find();
            if($count){
                $map['id'] = array('in',$count['cid']);
            }
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_comment')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=> Db::getLastSql()]);
        }else{
            $group = db('trill_commenting')->where('statu',1)->order('id desc')->select();
            $this->assign('group',$group);
            return $this->fetch();
        }
    }

    /**
     * 添加评论
     */
    public function commentadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['content'] = trim($data['content']);
            $content = db('trill_comment')->where('content',$data['content'])->find();
            if($content){
                return json(['code'=>0,'msg'=>'内容已经存在']);
            }
            $data['addtime'] = time();
            $insert = db('trill_comment')->insert($data);
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
     * 编辑评论
     */
    public function commentedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['content'] = trim($data['content']);
            $content = db('trill_comment')->where('content',$data['content'])->find();
            $res = db('trill_comment')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            if($content['id'] != $id && $content['content'] == $data['content']){
                return json(['code'=>0,'msg'=>'内容已经存在']);
            }
            $insert = db('trill_comment')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('trill_comment')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 删除评论
     */
    public function commentdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id']; 
            if(is_array($id)){
                //批量删除
                $all = db('trill_comment')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('trill_comment')->where('id',$id)->delete();
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
     * 评论分组管理
     */

    /**
     * 评论分组列表
     */
    public function commenting()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
            $map['name'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $map['statu'] = $statu;
            }
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_commenting')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>$_POST]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加评论分组
     */
    public function commentingadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['name'] = trim($data['name']);
            $infos = db('trill_commenting')->where('name',$data['name'])->find();
            if($infos){
                return json(['code'=>0,'msg'=>'分组名称已经存在']);
            }
            $data['addtime'] = time();
            $insert = db('trill_commenting')->insert($data);
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
     * 评论进行分组
     */
    public function commentinggroup()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['num'] = count(explode(',',$data['cid']));
            $count = db('trill_commenting')->field('statu')->where('id',$id )->find();
            if($count['statu'] == 0){
                return json(['code'=>0,'msg'=>'该分组已经禁用']);
            }
            $res = db('trill_commenting')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $insert = db('trill_commenting')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 编辑评论分组
     */
    public function commentingedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['name'] = trim($data['name']);
            $infos = db('trill_commenting')->where('name',$data['name'])->find();
            $res = db('trill_commenting')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            if($infos['id'] != $id && $infos['name'] == $data['name']){
                return json(['code'=>0,'msg'=>'分组名称已经存在']);
            }
            $insert = db('trill_commenting')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('trill_commenting')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 修改评论分组状态
     */
    public function commentingstatu()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $statu = input('post.statu');
            $update =db('trill_commenting')->where('id', $id)->update(['statu' => $statu]);
            if($update){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 删除评论分组
     */
    public function commentingdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('trill_commenting')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('trill_commenting')->where('id',$id)->delete();
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
     * 私信管理
     */

    /**
     * 私信列表
     */
    public function letterlist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
            $map['content'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_letter')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>$map]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加私信
     */
    public function letteradd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['content'] = trim($data['content']);
            $infos = db('trill_letter')->where('content',$data['content'])->find();
            if($infos){
                return json(['code'=>0,'msg'=>'内容已经存在']);
            }
            $data['addtime'] = time();
            $insert = db('trill_letter')->insert($data);
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
     * 编辑私信
     */
    public function letteredit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $res = db('trill_letter')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $insert = db('trill_letter')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('trill_letter')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 删除私信列表信息
     */
    public function letterdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('trill_letter')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('trill_letter')->where('id',$id)->delete();
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
     * 账号管理
     */

    /**
     * 账号列表
     */
    public function accountlist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
            $map['username'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $map['statu'] = $statu;
            }
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_account')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>Db::getLastSql()]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 删除账号
     */
    public function accountdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('trill_account')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('trill_account')->where('id',$id)->delete();
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
     * 修改账号状态
     */
    public function accounteditstatu()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $statu = input('post.statu');
            $update =db('trill_account')->where('id', $id)->update(['statu' => $statu]);
            if($update){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 播放量管理
     */

    /**
     * 播放量列表
     */
    public function playlist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
         /*   $map['content'] = ['like','%'.$key.'%'];*/
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_play')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>$map]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 播放量列表
     */
    public function playlists()
    {
        if(request() -> isPost()){
            $map = [];
            $key = trim(input('post.key'));
            /*   $map['content'] = ['like','%'.$key.'%'];*/
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $starttime = trim(input('post.starttime'));
            $endtime = trim(input('post.endtime'));
            if(!empty($starttime)){
                $map['addtime'] = array('elt', strtotime($starttime));
            }
            if(!empty($endtime)){
                $map['addtime'] = array('elt',strtotime($endtime));
            }
            if(!empty($starttime) && !empty($endtime)){
                $starttime = strtotime($starttime);
                $endtime = strtotime($endtime);
                $map['addtime'] = array('between', [$starttime, $endtime]);
            }
            $list = db('trill_play')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>$map]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 删除播放量列表信息
     */
    public function playdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('trill_play')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('trill_play')->where('id',$id)->delete();
                if($del){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }
        }
    }

    public function index()
    {
        return $this->fetch();
    }

    public function indexs()
    {
        return $this->fetch();
    }

    public function index1(){
        /*$list = db('trill_account') ->field('datatimes,id as count ')->select();*/
        $list = counts('trill_account','addtime');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function index2(){

        /*$list = db('trill_account') ->field('datatimes,count(`id`) as count')->group('datatimes')->select();*/
        /*$list = db('trill_account') ->field('datatimes,id as count ')->select();*/
        $list = counts('trill_account','addtime');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function index3(){
        $list = counts('trill_account','addtime');
        dump($list);

    }

    public function index4(){
        $page = input('page')?input('page'):1;
        $limit =input('limit')?input('limit'):10;
        $offset = ($page - 1) * $limit;
        $list = db('trill_comment')
            -> order('id desc')
            -> limit($offset,$limit)
            -> select();
        $count = db('trill_comment')
            -> order('id desc')
            -> count();
        $arr['count'] = $count;
        $arr['pages'] = $page;
        $arr['limit'] = $limit;
        $this->assign('list',$list);
        $this->assign('info',$arr);
        return $this->fetch();
    }

    public function index5()
    {
        return $this->fetch();
    }

}