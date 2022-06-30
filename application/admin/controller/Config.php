<?php
namespace app\admin\controller;
use clt\Leftnav;
use think\Loader;
class Config extends Common
{

    /**
     * 系统管理
     */

    /**
     * 系统设置信息
     */
    public function index()
    {   
        //配置信息
        $list = db('config')->field('name,value')->select();
        $info = array();
        foreach ($list as $key => $value) {
            $info[$value['name']] = $value['value'];
        }
        $this->assign('system', json_encode($info,true));
       /* $this->assign('info', $info);*/
        return $this->fetch();
    }

    /**
     * 编辑系统设置信息
     */
    public function edit()
    {
        if(request() -> isPost()){
            $data = input('post.');
            unset($data['file']);
            foreach ($data as $k=>$v){
                db('config')->where(['name'=>$k])->update(['value'=>$v]);
            }
            adminlog();
            return json(['code' => 1, 'msg' => '保存成功!', 'url' => url('config/index')]);
        }
    }

    /**
     * 应用类型管理
     */

    /**
     * 应用类型列表
     */
    public function typelist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = input('post.key');
            $map['name'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $map['statu'] = $statu;
            }
            $list = db('tag_type')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'name'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加应用类型信息
     */
    public function typeadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            $validate = Loader::validate('Configtype');
            /**
             * 验证不通过
             */
            if(!$validate->check($data)){
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
            /*$infos = db('tag_type')->where('name',$data['name'])->find();
            if($infos){
                return json(['code'=>0,'msg'=>'类型名称已经存在']);
            }*/
            $data['addtime'] = time();
            $insert = db('tag_type')->insert($data);
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
     * 编辑类型信息
     */
    public function typeedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $res = db('tag_type')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $validate = Loader::validate('Configtype');
            /**
             * 验证不通过
             */
            if(!$validate->check($data)){
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
           /* $infos = db('tag_type')->where('name',$data['name'])->find();
            if($infos['id'] != $id && $infos['name'] == $data['name']){
                return json(['code'=>0,'msg'=>'类型名称已经存在']);
            }*/
            $insert = db('tag_type')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('tag_type')->where('id',$id)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 删除修改平台状态
     */
    public function typedel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('tag_type')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('tag_type')->where('id',$id)->delete();
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
     * 修改类型状态
     */
    public function typestatu()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $statu = input('post.statu');
            $update =db('tag_type')->where('id', $id)->update(['statu' => $statu]);
            if($update){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 应用标识管理
     */

    /**
     * 应用标识列表
     */
    public function taglist()
    {
        if(request() -> isPost()){
            $map = [];
            $key = input('post.key');
            $map['a.name'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //使用状态
            $statu = input('post.statu');
            if(is_numeric($statu)){
                $map['a.statu'] = $statu;
            }
            $list = db('tag')
                -> alias('a')
                -> field('a.*,b.name as typename')
                -> join('tag_type b','a.type = b.id','left')
                -> where($map)
                -> order('id desc')
                -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                -> toArray();
            if($list['data']){
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }
            }
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'name'=>1]);
        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加应用标识
     */
    public function tagadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
          /*  $infos = db('tag')->where('name',$data['name'])->find();
            if($infos){
                return json(['code'=>0,'msg'=>'应用名称已经存在']);
            }

            $tagname = db('tag')->where('tagname',$data['tagname'])->find();
            if($tagname){
                return json(['code'=>0,'msg'=>'应用标识已经存在']);
            }*/
            $validate = Loader::validate('Configtag');
            if(!$validate->check($data)){
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
            $data['addtime'] = time();
            $insert = db('tag')->insert($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'添加成功']);
            }else{
                return json(['code'=>0,'msg'=>'添加失败']);
            }
        }else{
            //应用类型信息
            $type = db('tag_type')->where('statu',1)->select();
            $this->assign('type',$type);
            return $this->fetch();
        }
    }

    /**
     * 编辑应用标识
     */
    public function tagedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            $res = db('tag')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            /*$infos = db('tag')->where('name',$data['name'])->find();
            if($infos['id'] != $id && $infos['name'] == $data['name']){
                return json(['code'=>0,'msg'=>'类型名称已经存在']);
            }
            $infostag= db('tag')->where('tagname',$data['tagname'])->find();
            if($infostag['id'] != $id && $infostag['tagname'] == $data['tagname']){
                return json(['code'=>0,'msg'=>'应用标识已经存在']);
            }*/
            $validate = Loader::validate('Configtag');
            if(!$validate->check($data)){
                return json(['code'=>0,'msg'=>$validate->getError()]);
            }
            $insert = db('tag')->where('id',$id)->update($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('tag')->where('id',$id)->find();
            //应用类型信息
            $type = db('tag_type')->where('statu',1)->select();
            $this->assign('type',$type);
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 修改应用标识状态
     */
    public function tagstatu()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $statu = input('post.statu');
            $update =db('tag')->where('id', $id)->update(['statu' => $statu]);
            if($update){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 删除应用标识
     */
    public function tagdel()
    {
        if(request() ->isPost()){
            $id = $_POST['id'];
            if(is_array($id)){
                //批量删除
                $all = db('tag')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('tag')->where('id',$id)->delete();
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
     * 用户权限管理
     */

    /**
     * 权限列表
     */
    public function accesslist()
    {
        if(request() -> isPost()){
            $nav = new Leftnav();
            $authRule = db('user_auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$arr,'rel'=>1]);

        }else{
            return $this->fetch();
        }
    }

    /**
     * 添加权限
     */
    public function accessadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            if($data['pid'] == 0){
                $data['levels'] = 1;
            }else{
                $levels = db('user_auth_rule')->field('levels')->where('id',$data['pid'])->find();
                $data['levels'] = $levels['levels']+1;
            }
            $data['addtime'] = time();
            $data['title'] = trim($data['title']);
            $data['href'] = trim($data['href']);
            $insert = db('user_auth_rule')->insert($data);
            if($insert){
                adminlog();
                return json(['code'=>1,'msg'=>'添加成功']);
            }else{
                return json(['code'=>0,'msg'=>'添加失败']);
            }
        }else{
            $nav = new Leftnav();
            $authRule = db('user_auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            $this->assign('user_rule',$arr);//权限列表
            return $this->fetch();
        }
    }


    /**
     * 编辑权限
     */
    public function accessedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            if($data['pid'] == 0){
                $data['levels'] = 1;
            }else{
                $levels = db('user_auth_rule')->field('levels')->where('id',$data['pid'])->find();
                $data['levels'] = $levels['levels']+1;
            }
            $data['title'] = trim($data['title']);
            $data['href'] = trim($data['href']);
            $res = db('user_auth_rule')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $update =db('user_auth_rule')->where('id', $id)->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>0,'msg'=>'修改失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('user_auth_rule')->where('id',$id)->find();
            $nav = new Leftnav();
            $authRule = db('user_auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            $this->assign('user_rule',$arr);//权限列表
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    /**
     * 权限管理设置权限是否验证
     */
    public function authopen()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $authopen = input('post.authopen');
            $update =db('user_auth_rule')->where('id', $id)->update(['authopen' => $authopen]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 权限管理设置菜单状态
     */
    public function menustatus()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $menustatus = input('post.menustatus');
            $update =db('user_auth_rule')->where('id', $id)->update(['menustatus' => $menustatus]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 权限管理设置排序
     */
    public function rulesort()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $sort = input('post.sort');
            $update =db('user_auth_rule')->where('id', $id)->update(['sort' => $sort]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    /**
     * 删除权限列表
     */
    public function accessdel(){
        if(request() -> isPost()){
            $id = input('param.id');
            $pid = db('user_auth_rule')->where('pid',$id)->find();
            if($pid){
                return json(['code'=>0,'msg'=>'不能进行删除,下级有分类']);
            }
            $del = db('user_auth_rule')->where('id',$id)->delete();
            if($del){
                adminlog();
                return json(['code'=>1,'msg'=>'删除成功']);
            }else{
                return json(['code'=>0,'msg'=>'删除失败']);
            }
        }
    }




}