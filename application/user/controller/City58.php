<?php
namespace  app\user\controller;
use think\Loader;
class City58 extends Common
{
    /**
     * 58同城管理
     */


    /**
     * 账号管理
     */

    /**
     * @列表信息
     * $limit         分页查询条数
     * $page          当前页数
     * $field         查询字段
     * $order         排序
     * $tagname       应用标识
     * $starttime     开始时间
     * $type          搜索类型
     * $key           关键字搜索
     * $userid        用户ID
     */
    public function accountlist()
    {
        if(request() -> isPost()){
            $limit =input('limit')?input('limit'):10;
            $page = input('page')?input('page'):1;
            $field     = 'id,username,password,statu,addtime,codes';
            $order     = 'id';
            $query = [];
            $tagname = MODULENAME;
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            $starttimes = strtotime($starttime);
            $endtimes = strtotime($endtime);
            $type = input('post.type');
            $key = input('post.key');
            $userid = session('userid');
            if(!empty($tagname)){
                $query[] = "tagname = '{$tagname}'";
            }

            if($userid != 1){
                $query[] = "uid = $userid";
            }

            /**
             * 使用状态
             */
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $query[] = "statu = $statu";
            }

            /**
             * 时间筛选
             */
            if(!empty($starttime) && !empty($endtime)){
                $query[] = "addtime BETWEEN $starttimes AND $endtimes";
            }elseif(!empty($starttime)){
                $query[] = "addtime <= $starttimes";
            }elseif(!empty($endtime)){
                $query[] = "addtime <= $endtimes";
            }else{
                unset($starttime);
                unset($endtime);
            }

            /**
             * 关键字搜索
             */
            if(!empty($key) && !empty($type)){
                $key = '%'.$key.'%';
                $query[] = "$type LIKE '{$key}'";
            }

            $data = model('Common')->lists('user_account',$limit,$page,$query,$field,$order);
            if($data['list']){
                foreach ($data['list'] as $key => $value){
                    $data['list'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$data['list'],'count'=>$data['count'],'rel'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 编辑账号状态
     */
    public function accountstatu()
    {
        if(request() -> isPost()){
            $datainfo = input('post.');
            $arrjson = model('Common')
                -> statu($datainfo,'user_account');
            return json($arrjson);
        }
    }

    /**
     * 删除账号
     */
    public function accountdel()
    {
        if(request() -> isPost()){
            $id = $_POST['id'];
            $arrjson = model('Common')
                -> del($id,'user_account');
            return json($arrjson);
        }
    }

    /**
     * 评论管理
     */
    /**
     * @列表信息
     * $limit         分页查询条数
     * $page          当前页数
     * $field         查询字段
     * $order         排序
     * $tagname       应用标识
     * $starttime     开始时间
     * $type          搜索类型
     * $key           关键字搜索
     * $userid        用户ID
     */
    public function commentlist()
    {
        if(request() -> isPost()){
            $limit =input('limit')?input('limit'):10;
            $page = input('page')?input('page'):1;
            $field     = 'id,content,statu,addtime,gid';
            $order     = 'id';
            $query = [];
            $tagname = MODULENAME;
            $statu = input('post.statu');
            $gid = input('post.gid');
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            $starttimes = strtotime($starttime);
            $endtimes = strtotime($endtime);
            $type = input('post.type');
            $key = input('post.key');
            $userid = session('userid');
            if(!empty($tagname)){
                $query[] = "tagname = '{$tagname}'";
            }

            /*if($userid != 1){
                $query[] = "uid = $userid";
            }*/
            if(!empty($userid)){
                $query[] = "uid = $userid";
            }

            /**
             * 查看下级
             */
            if(!empty($gid)){
                $query[] = "gid = $gid";
            }

            /**
             * 使用状态
             */
            if(is_numeric($statu)){
                $query[] = "statu = $statu";
            }

            /**
             * 时间筛选
             */
            if(!empty($starttime) && !empty($endtime)){
                $query[] = "addtime BETWEEN $starttimes AND $endtimes";
            }elseif(!empty($starttime)){
                $query[] = "addtime <= $starttimes";
            }elseif(!empty($endtime)){
                $query[] = "addtime <= $endtimes";
            }else{
                unset($starttime);
                unset($endtime);
            }

            /**
             * 关键字搜索
             */
            if(!empty($key) && !empty($type)){
                $key = '%'.$key.'%';
                $query[] = "$type LIKE '{$key}'";
            }

            $data = model('Common')->lists('user_comment',$limit,$page,$query,$field,$order);
            if(is_array($data['list'])){
                foreach ($data['list'] as $key => $value){
                    $data['list'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                    $gname = $this->commentgroupname($value['gid']);
                    $data['list'][$key]['gname'] = $gname['name'];
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$data['list'],'count'=>$data['count'],'rel'=>1]);
        }else{
            $userid = session('userid');
            $map['statu'] = 1;
            $map['tagname'] = MODULENAME;
            if($userid != 1){
                $map['uid'] = $userid;
            }
            $group = db('user_commentgroup')
                -> where($map)
                -> order('id desc')
                -> select();
            $this->assign('group',$group);
            return $this->fetch();
        }
    }

    /**
     * @分组名称匹配
     */
    public function commentgroupname($gid)
    {
        $info = db('user_commentgroup')
            -> field('name')
            -> where('id',$gid)
            -> find();
        return $info;
    }

    /**
     * 添加评论
     */
    public function commentadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['uid'] = session('userid');
            $data['tagname'] = MODULENAME;
            $arrs = $data;
            unset($arrs['content']);
            $count = db('user_comment')->where($data)->find();
            if($count){
                $validate = Loader::validate('Comment');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $data['addtime'] = time();
            model('Common')
                ->leveltable('user_comment_ping','user_comment',200000);
            $arrjson = model('Common')
                -> adds($data,'user_comment','user_commentgroup');
            return json($arrjson);
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
            $arrs = $data;
            unset($arrs['id']);
            unset($arrs['content']);
            $arrs['uid'] = session('userid');
            $arrs['tagname'] = MODULENAME;
            $count = db('user_comment')->where($arrs)->find();
            if($count){
                $validate = Loader::validate('Comment');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $arrjson = model('Common')
                -> edit('id',$id,$data,'user_comment');
            return json($arrjson);
        }else{
            $id = input('get.id');
            $info = db('user_comment')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 编辑评论状态
     */
    public function commentstatu()
    {
        if(request() -> isPost()){
            $datainfo = input('post.');
            $arrjson = model('Common')
                -> statu($datainfo,'user_comment');
            return json($arrjson);
        }
    }

    /**
     * 删除评论
     */
    public function commentdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            $gid = input('post.gid');
            $arrjson = model('Common')
                -> dels($id,'user_comment','user_commentgroup',$gid);
            return json($arrjson);
        }
    }

    /**
     * 查看评论分组下的评论内容
     */
    public function commentsee()
    {
        return $this->fetch();
    }

    /**
     * 评论分组管理
     */

    /**
     * @列表信息
     * $limit         分页查询条数
     * $page          当前页数
     * $field         查询字段
     * $order         排序
     * $tagname       应用标识
     * $starttime     开始时间
     * $type          搜索类型
     * $key           关键字搜索
     * $userid        用户ID
     */
    public function commentgroup()
    {
        if(request() -> isPost()){
            $limit =input('limit')?input('limit'):10;
            $page = input('page')?input('page'):1;
            $field     = 'id,name,num,statu,addtime,updatetime';
            $order     = 'id';
            $query = [];
            $tagname = MODULENAME;
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            $starttimes = strtotime($starttime);
            $endtimes = strtotime($endtime);
            $type = input('post.type');
            $key = input('post.key');
            $userid = session('userid');
            if(!empty($tagname)){
                $query[] = "tagname = '{$tagname}'";
            }

            /* if($userid != 1){
                 $query[] = "uid = $userid";
             }*/
            if(!empty($userid)){
                $query[] = "uid = $userid";
            }

            /**
             * 使用状态
             */
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $query[] = "statu = $statu";
            }

            /**
             * 时间筛选
             */
            if(!empty($starttime) && !empty($endtime)){
                $query[] = "addtime BETWEEN $starttimes AND $endtimes";
            }elseif(!empty($starttime)){
                $query[] = "addtime <= $starttimes";
            }elseif(!empty($endtime)){
                $query[] = "addtime <= $endtimes";
            }else{
                unset($starttime);
                unset($endtime);
            }

            /**
             * 关键字搜索
             */
            if(!empty($key) && !empty($type)){
                $key = '%'.$key.'%';
                $query[] = "$type LIKE '{$key}'";
            }

            $data = model('Common')->lists('user_commentgroup',$limit,$page,$query,$field,$order);
            if(is_array($data['list'])){
                foreach ($data['list'] as $key => $value){
                    $data['list'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                    if($value['updatetime'] == ""){
                        $data['list'][$key]['updatetime'] = "";
                    }else{
                        $data['list'][$key]['updatetime'] = date('Y-m-d H:i:s',$value['updatetime']);
                    }

                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$data['list'],'count'=>$data['count'],'rel'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加评论分组
     */
    public function commentgroupadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['uid'] = session('userid');
            $data['tagname'] = MODULENAME;
            $arrs = $data;
            unset($arrs['name']);
            $count = db('user_commentgroup')->where($data)->find();
            if($count){
                $validate = Loader::validate('Commentgroup');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            /*$validate = Loader::validate('Commentgroup');
            if(!$validate->check($data)){
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }*/
            $data['addtime'] = time();
            model('Common')
                ->leveltable('user_commentgroup_ping','user_commentgroup',200000);
            $arrjson = model('Common')
                -> add($data,'user_commentgroup');
            return json($arrjson);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 编辑评论分组
     */
    public function commentgroupedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $arrs = $data;
            unset($arrs['id']);
            unset($arrs['name']);
            $arrs['uid'] = session('userid');
            $arrs['tagname'] = MODULENAME;
            $count = db('user_commentgroup')->where($arrs)->find();
            if($count){
                $validate = Loader::validate('Commentgroup');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            /* $validate = Loader::validate('Commentgroup');
             if(!$validate->check($data)){
                 return json(['code'=>0,'msg'=>$validate->getError()]);
             }*/
            $arrjson = model('Common')
                -> edits('id',$id,$data,'user_commentgroup');
            return json($arrjson);
        }else{
            $id = input('get.id');
            $info = db('user_commentgroup')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 编辑评论分组状态
     */
    public function commentgroupstatu()
    {
        if(request() -> isPost()){
            $datainfo = input('post.');
            $arrjson = model('Common')
                -> statu($datainfo,'user_commentgroup');
            return json($arrjson);
        }
    }

    /**
     * 评论进行分组
     */
    public function commentgroups()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['num'] = count(explode(',',$data['cid']));
            $count = db('user_commentgroup')->field('statu')->where('id',$id )->find();
            if($count['statu'] == 0){
                return json(['code'=>0,'msg'=>'该分组已经禁用']);
            }
            $res = db('user_commentgroup')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $arrjson = model('Common')
                -> edit('id',$id,$data,'user_commentgroup');
            return json($arrjson);
        }
    }


    /**
     * 删除评论分组
     */
    public function commentgroupdel()
    {
        if(request() -> isPost()){
            $id = $_POST['id'];
            $arrjson = model('Common')
                -> groupdel($id,'user_commentgroup','user_comment');
            return json($arrjson);
        }
    }

    /**
     * 私信管理
     */
    /**
     * @列表信息
     * $limit         分页查询条数
     * $page          当前页数
     * $field         查询字段
     * $order         排序
     * $tagname       应用标识
     * $starttime     开始时间
     * $type          搜索类型
     * $key           关键字搜索
     * $userid        用户ID
     */
    public function letterlist()
    {
        if(request() -> isPost()){
            $limit =input('limit')?input('limit'):10;
            $page = input('page')?input('page'):1;
            $field     = 'id,content,statu,addtime,gid';
            $order     = 'id';
            $query = [];
            $tagname = MODULENAME;
            $statu = input('post.statu');
            $gid = input('post.gid');
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            $starttimes = strtotime($starttime);
            $endtimes = strtotime($endtime);
            $type = input('post.type');
            $key = input('post.key');
            $userid = session('userid');
            if(!empty($tagname)){
                $query[] = "tagname = '{$tagname}'";
            }

            /*if($userid != 1){
                $query[] = "uid = $userid";
            }*/
            if(!empty($userid)){
                $query[] = "uid = $userid";
            }

            /**
             * 查看下级
             */
            if(!empty($gid)){
                $query[] = "gid = $gid";
            }

            /**
             * 使用状态
             */
            if(is_numeric($statu)){
                $query[] = "statu = $statu";
            }

            /**
             * 时间筛选
             */
            if(!empty($starttime) && !empty($endtime)){
                $query[] = "addtime BETWEEN $starttimes AND $endtimes";
            }elseif(!empty($starttime)){
                $query[] = "addtime <= $starttimes";
            }elseif(!empty($endtime)){
                $query[] = "addtime <= $endtimes";
            }else{
                unset($starttime);
                unset($endtime);
            }

            /**
             * 关键字搜索
             */
            if(!empty($key) && !empty($type)){
                $key = '%'.$key.'%';
                $query[] = "$type LIKE '{$key}'";
            }

            $data = model('Common')->lists('user_letter',$limit,$page,$query,$field,$order);
            if(is_array($data['list'])){
                foreach ($data['list'] as $key => $value){
                    $data['list'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                    $gname = $this->commentgroupname($value['gid']);
                    $data['list'][$key]['gname'] = $gname['name'];
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$data['list'],'count'=>$data['count'],'rel'=>1]);
        }else{
            $userid = session('userid');
            $map['statu'] = 1;
            $map['tagname'] = MODULENAME;
            if($userid != 1){
                $map['uid'] = $userid;
            }
            $group = db('user_lettergroup')
                -> where($map)
                -> order('id desc')
                -> select();
            $this->assign('group',$group);
            return $this->fetch();
        }
    }

    /**
     * @分组名称匹配
     */
    public function lettergroupname($gid)
    {
        $info = db('user_lettergroup')
            -> field('name')
            -> where('id',$gid)
            -> find();
        return $info;
    }

    /**
     * 添加私信
     */
    public function letteradd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $data['uid'] = session('userid');
            $data['tagname'] = MODULENAME;
            $arrs = $data;
            unset($arrs['content']);
            $count = db('user_letter')->where($data)->find();
            if($count){
                $validate = Loader::validate('Letter');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $data['addtime'] = time();
            model('Common')
                ->leveltable('user_letter_ping','user_letter',200000);
            $arrjson = model('Common')
                -> adds($data,'user_letter','user_lettergroup');
            return json($arrjson);
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
            $arrs = $data;
            unset($arrs['id']);
            unset($arrs['content']);
            $arrs['uid'] = session('userid');
            $arrs['tagname'] = MODULENAME;
            $count = db('user_letter')->where($arrs)->find();
            if($count){
                $validate = Loader::validate('Letter');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $arrjson = model('Common')
                -> edit('id',$id,$data,'user_letter');
            return json($arrjson);
        }else{
            $id = input('get.id');
            $info = db('user_letter')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 编辑私信状态
     */
    public function letterstatu()
    {
        if(request() -> isPost()){
            $datainfo = input('post.');
            $arrjson = model('Common')
                -> statu($datainfo,'user_letter');
            return json($arrjson);
        }
    }

    /**
     * 删除私信
     */
    public function letterdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            $gid = input('post.gid');
            $arrjson = model('Common')
                -> dels($id,'user_letter','user_lettergroup',$gid);
            return json($arrjson);
        }
    }

    /**
     * 查看私信分组下的评论内容
     */
    public function lettersee()
    {
        return $this->fetch();
    }

    /**
     * 私信分组管理
     */

    /**
     * @列表信息
     * $limit         分页查询条数
     * $page          当前页数
     * $field         查询字段
     * $order         排序
     * $tagname       应用标识
     * $starttime     开始时间
     * $type          搜索类型
     * $key           关键字搜索
     * $userid        用户ID
     */
    public function lettergroup()
    {
        if(request() -> isPost()){
            $limit =input('limit')?input('limit'):10;
            $page = input('page')?input('page'):1;
            $field     = 'id,name,num,statu,addtime,updatetime';
            $order     = 'id';
            $query = [];
            $tagname = MODULENAME;
            $starttime = input('post.starttime');
            $endtime = input('post.endtime');
            $starttimes = strtotime($starttime);
            $endtimes = strtotime($endtime);
            $type = input('post.type');
            $key = input('post.key');
            $userid = session('userid');
            if(!empty($tagname)){
                $query[] = "tagname = '{$tagname}'";
            }

            /* if($userid != 1){
                 $query[] = "uid = $userid";
             }*/
            if(!empty($userid)){
                $query[] = "uid = $userid";
            }

            /**
             * 使用状态
             */
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $query[] = "statu = $statu";
            }

            /**
             * 时间筛选
             */
            if(!empty($starttime) && !empty($endtime)){
                $query[] = "addtime BETWEEN $starttimes AND $endtimes";
            }elseif(!empty($starttime)){
                $query[] = "addtime <= $starttimes";
            }elseif(!empty($endtime)){
                $query[] = "addtime <= $endtimes";
            }else{
                unset($starttime);
                unset($endtime);
            }

            /**
             * 关键字搜索
             */
            if(!empty($key) && !empty($type)){
                $key = '%'.$key.'%';
                $query[] = "$type LIKE '{$key}'";
            }

            $data = model('Common')->lists('user_lettergroup',$limit,$page,$query,$field,$order);
            if(is_array($data['list'])){
                foreach ($data['list'] as $key => $value){
                    $data['list'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                    if($value['updatetime'] == ""){
                        $data['list'][$key]['updatetime'] = "";
                    }else{
                        $data['list'][$key]['updatetime'] = date('Y-m-d H:i:s',$value['updatetime']);
                    }

                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$data['list'],'count'=>$data['count'],'rel'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加私信分组
     */
    public function lettergroupadd()
    {

        if(request() -> isPost()){
            $data = input('post.');
            $data['uid'] = session('userid');
            $data['tagname'] = MODULENAME;
            $arrs = $data;
            unset($arrs['name']);
            $count = db('user_lettergroup')->where($data)->find();
            if($count){
                $validate = Loader::validate('Lettergroup');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $data['addtime'] = time();
            model('Common')
                ->leveltable('user_lettergroup_ping','user_lettergroup',200000);
            $arrjson = model('Common')
                -> add($data,'user_lettergroup');
            return json($arrjson);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 编辑私信分组
     */
    public function lettergroupedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $arrs = $data;
            unset($arrs['id']);
            unset($arrs['name']);
            $arrs['uid'] = session('userid');
            $arrs['tagname'] = MODULENAME;
            $count = db('user_lettergroup')->where($arrs)->find();
            if($count){
                $validate = Loader::validate('Lettergroup');
                if(!$validate->check($data)){
                    return json(['code'=>0,'msg'=>$validate->getError()]);
                }
            }
            $arrjson = model('Common')
                -> edits('id',$id,$data,'user_lettergroup');
            return json($arrjson);
        }else{
            $id = input('get.id');
            $info = db('user_lettergroup')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 编辑私信分组状态
     */

    public function lettergroupstatu()
    {
        if(request() -> isPost()){
            $datainfo = input('post.');
            $arrjson = model('Common')
                -> statu($datainfo,'user_lettergroup');
            return json($arrjson);
        }
    }

    /**
     * 私信进行分组
     */
    public function lettergroups()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $data['num'] = count(explode(',',$data['cid']));
            $count = db('user_commentgroup')->field('statu')->where('id',$id )->find();
            if($count['statu'] == 0){
                return json(['code'=>0,'msg'=>'该分组已经禁用']);
            }
            $res = db('user_commentgroup')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $arrjson = model('Common')
                -> edit('id',$id,$data,'user_commentgroup');
            return json($arrjson);
        }
    }
}
