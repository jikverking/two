<?php
namespace app\admin\controller;
use think\Db;
use clt\Leftnav;
use app\admin\model\Admin;
use app\admin\model\AuthGroup;
use app\admin\model\AuthRule;
use think\Request; 
use think\Validate;
class Auth extends Common
{
    //管理员列表
    public function adminlist()  
    {
        if(request() -> isPost()){
            $map = [];
            //使用状态
            $is_open = input('post.is_open');
            if(is_numeric($is_open)){
                $map['is_open'] = $is_open;
            }
            $key = trim(input('post.key'));
            $map['username|email|tel'] = ['like','%'.$key.'%'];
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $list = db('admin')
               /*  -> where('username|email|tel','like','%'.$key.'%')*/
                 -> where($map)
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            if($list['data']){     
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
                    $list['data'][$key]['title'] = $this->title($value['group_id']);
                    if($value['logintime'] == ''){
                        $list['data'][$key]['logintime'] = '';
                    }else{
                        $list['data'][$key]['logintime'] = date('Y-m-d H:i:s',$value['logintime']);
                    }
                }  
            }             
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1,'datas'=>$map]);
        }else{
            return $this->fetch();
        }
    }

    //用户组匹配
    public function title($id)
    {
        $list = db('auth_group')->where('group_id',$id)->find();
        return $list['title'];
    }

    //用户个人信息
    public function info(){
        $adminid = session('adminid');
        $list = db('admin')->where('adminid',$adminid)->find();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加管理员
    public function adminadd()
    {
        if(request() ->isPost()){
            $data = input('post.');
          //  dump($data);die();
            $data['username'] = trim($data['username']);
            $data['salt'] = randoma(8);
            $password = trim($data['password']);
            $data['password'] = md5(md5($password).$data['salt']);
            $data['email'] = trim($data['email']);
            $data['tel'] = trim($data['tel']);
            $data['add_time'] = time();
            $data['ip'] = request()->ip();
            unset($data['file']);
            $res = db('admin')->where('username',$data['username'])->find();
            if($res){
                return json(['code'=>0,'msg'=>'用户名已经存在']);
            }
            $admin = db('admin')->insertGetId($data);
            if($admin){
                adminlog();
                return json(['code'=>1,'msg'=>'添加成功','url' => url('auth/adminlist')]);
            }else{
                return json(['code'=>0,'msg'=>'添加失败']);
            }
        }else{    
            //用户组列表信息
            $group = db('auth_group')->select();
            $this->assign('group',$group);
            return $this->fetch();
        }
    }

    //更新管理员信息
    public function adminedit()
    {
        if(request() -> isPost()){
            $adminid = input('post.adminid');
            $data = input('post.');
            unset($data['file']);
            $data['username'] = trim($data['username']);
            $data['email'] = trim($data['email']);
            $data['tel'] = trim($data['tel']);
            $sql = db('admin')->where('adminid',$adminid)->find();
            //判断图片是够存在，存在进行删除
            if($sql['avatar'] != $data['avatar'] && $sql['avatar']!= ""){
                $fileurl = ROOT_PATH. 'public' . $sql['avatar'];
                if(file_exists($fileurl)){
                    unlink($fileurl);
                }
            }
            $res = db('admin')->where('username',$data['username'])->find();
            $ress = db('admin')->where($data)->find();
            if($ress){
                return json(['code'=>1,'msg'=>'编辑成功','url' => url('auth/adminlist')]);
            }
            if($res['adminid'] != $adminid && $res['username'] == $data['username']){
                return json(['code'=>0,'msg'=>'用户名已经存在']);
            }
            $update =db('admin')->where('adminid', $adminid)->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功','url' => url('auth/adminlist')]);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('admin')->where('adminid',$id)->find();
            ///用户组列表信息
            $group = db('auth_group')->select();
            $this->assign('group',$group);
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    //上传头像
    public function upimagesinfo(){
        $adminid = input('param.adminid');
        $files = trim(input('param.files'));
        $fileKey = array_keys(request()->file());
        // 获取表单上传文件
        $file = request()->file($fileKey['0']);
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . $files);
        if($info){
            $result['code'] = 1;
            $result['msg'] = '上传成功!';
            $path=str_replace('\\','/',$info->getSaveName());
            $data['avatar'] = '/uploads/'. $files.'/'. $path;
            $sql = db('admin')->where('adminid',$adminid)->find();
            //判断图片是够存在，存在进行删除
            if($sql['avatar'] != $data['avatar'] && $sql['avatar']!= ""){
                $fileurl = ROOT_PATH. 'public' . $sql['avatar'];
                if(file_exists($fileurl)){
                    unlink($fileurl);
                }
            }
            db('admin')->where('adminid', $adminid)->update($data);
            //$image = \think\Image::open(ROOT_PATH . 'public' . DS . 'uploads'. DS . $files. DS . $path);
            //$image->thumb(150,150,\think\Image::THUMB_CENTER)->save(ROOT_PATH . 'public' . DS . 'uploads'. DS . $files. DS .date('Ymd'). DS . 'sm_'.$info->getFilename());
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] = 0;
            $result['msg'] = '上传失败!';
            return $result;
        }
    }

    //编辑管理员状态
    public function admineditopen()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $is_open = input('post.is_open');
            if(empty($id)){
                return json(['code'=>0,'msg'=>'用户ID不存在']);
            }
            $update =db('admin')->where('adminid', $id)->update(['is_open' => $is_open]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    //修改管理员密码
    public function editpass($id = '')
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = array();
            $password = trim(input('post.password'));
            $users = db('admin')->field('salt,password')->where('adminid',$id)->find();
            $md5 = md5(md5($password).$users['salt']);
            if($md5 == $users['password']){
                return json(['code'=>1,'msg'=>'编辑成功','url' => url('auth/adminlist')]);
            }
            $data['password'] = $md5;
            $update = db('admin')->where('adminid', $id)->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功','url' => url('auth/adminlist')]);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }else{
            return $this->fetch();
        }
    }

    //删除管理员单条记录(删除数据)
    public function admindel()
    {   
        $data['adminid'] = input('param.id'); 
        if (session('adminid')==1){
            $admin = db('admin')->where($data)->find();
            if($admin['avatar'] != ''){
                $fileurl = ROOT_PATH. 'public' . $admin['avatar'];
                if(file_exists($fileurl)){
                    unlink($fileurl);
                }
            }
            db('admin')->where($data)->delete();
            adminlog();
            return json(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json(['code'=>0,'msg'=>'您没有删除管理员的权限']);
        } 
    }

    //用户组列表
    public function admingroup()
    {
        if(request() -> isPost()){
            $key = trim(input('post.key'));
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            //获取列表信息
            $list = db('auth_group')
                     -> where('title','like','%'.$key.'%')
                     -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                     -> toArray();
            if($list['data']){     
                foreach ($list['data'] as $key => $value) {
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                }  
            }             
            return json(['code'=>0,'msg'=>'获取成功！','data'=>$list['data'],'count'=>$list['total'],'rel'=>1]);
        }else{
            return $this->fetch();
        }
    }

    //添加用户组
    public function groupadd()
    {
        if(request() -> isPost()){
            $data=input('post.');
            $data['addtime']=time();
            AuthGroup::create($data);
            adminlog();
            return json(['code'=>1,'msg'=>'添加成功','url' => url('auth/admingroup')]);
        }else{
            return $this->fetch();
        }
    }

    //编辑用户组
    public function groupedit()
    {
        if(request() -> isPost()){
            $id = input('post.group_id');
            $data = input('post.');
            $data['title'] = trim($data['title']);
            $count = db('auth_group')->where($data)->find();
            if($count){
                adminlog();
                return json(['code'=>1,'msg'=>'用户组修改成功','url' => url('auth/admingroup')]);
            }
            $update =db('auth_group')->where('group_id', $id)->update($data);
            if($update){
                return json(['code'=>1,'msg'=>'用户组修改成功','url' => url('auth/admingroup')]);
            }else{
                adminlog();
                return json(['code'=>0,'msg'=>'用户组修改失败']);
            }
        }else{
            $id = input('id');
            $info = AuthGroup::get(['group_id'=>$id]);
            $this->assign('info',$info);
            return $this->fetch(); 
        }
    }

    //删除用户组
    public function groupdel()
    {
        if(request() -> isPost()){
            AuthGroup::destroy(['group_id'=>input('id')]);
            adminlog();
            return $result = ['code'=>1,'msg'=>'删除成功!'];
        }
    }

    //权限列表
    public function adminrule()
    {
        if(request() -> isPost()){
            $nav = new Leftnav();
            $authRule = db('auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$arr,'rel'=>1]);

        }else{
            return $this->fetch();
        }
    }

    //添加权限
    public function ruleadd()
    {
        if(request() -> isPost()){
            $data = input('post.');
            if($data['pid'] == 0){
                $data['levels'] = 1;
            }else{
                $levels = db('auth_rule')->field('levels')->where('id',$data['pid'])->find();
                $data['levels'] = $levels['levels']+1;
            }
            $data['addtime'] = time();
            $data['title'] = trim($data['title']);
            $data['href'] = trim($data['href']);
            AuthRule::create($data);
            adminlog();
            return json(['code'=>1,'msg'=>'添加成功']);
        }else{
            $nav = new Leftnav();
            $authRule = db('auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            $this->assign('admin_rule',$arr);//权限列表
            return $this->fetch();
        }
    }

    //编辑权限
    public function ruleedit()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $data = input('post.');
            if($data['pid'] == 0){
                $data['levels'] = 1;
            }else{
                $levels = db('auth_rule')->field('levels')->where('id',$data['pid'])->find();
                $data['levels'] = $levels['levels']+1;
            }
            $data['title'] = trim($data['title']);
            $data['href'] = trim($data['href']);
            $res = db('auth_rule')->where($data)->find();
            if($res){
                return json(['code'=>1,'msg'=>'编辑成功']);
            }
            $update =db('auth_rule')->where('id', $id)->update($data);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'修改成功']);
            }else{
                return json(['code'=>0,'msg'=>'修改失败']);
            }
        }else{
            $id = input('get.id');
            $info = db('auth_rule')->where('id',$id)->find();
            $nav = new Leftnav();
            $authRule = db('auth_rule')->order('sort asc,title desc')->select();
            $arr = $nav->menu($authRule);
            $this->assign('admin_rule',$arr);//权限列表
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    
    //删除权限列表
    public function ruledel(){
        if(request() -> isPost()){
            $id = input('param.id');
            $pid = db('auth_rule')->where('pid',$id)->find();
            if($pid){
                return json(['code'=>0,'msg'=>'不能进行删除,下级有分类']);
            }
            AuthRule::destroy(['id'=>input('param.id')]);
            adminlog();
            return json(['code'=>1,'msg'=>'删除成功']);
        }   
    }

    //权限管理设置权限是否验证
    public function authopen()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $authopen = input('post.authopen');
            $update =db('auth_rule')->where('id', $id)->update(['authopen' => $authopen]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    //权限管理设置菜单状态
    public function menustatus()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $menustatus = input('post.menustatus');
            $update =db('auth_rule')->where('id', $id)->update(['menustatus' => $menustatus]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    //权限管理设置排序
    public function rulesort()
    {
        if(request() -> isPost()){
            $id = input('post.id');
            $sort = input('post.sort');
            $update =db('auth_rule')->where('id', $id)->update(['sort' => $sort]);
            if($update){
                adminlog();
                return json(['code'=>1,'msg'=>'编辑成功','url'=>url('adminrule')]);
            }else{
                return json(['code'=>0,'msg'=>'编辑失败']);
            }
        }
    }

    //分组配置规则
    public function groupaccess()
    {   
        $nav = new Leftnav();
        $admin_rule=db('auth_rule')->field('id,pid,title')->order('sort asc,title desc')->select();
        $rules = db('auth_group')->where('group_id',input('id'))->value('rules');
        $arr = $nav->auth($admin_rule,$pid=0,$rules);

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
        if(AuthGroup::update($data)){
            adminlog();
            return array('msg'=>'权限配置成功!','url'=>url('admingroup'),'code'=>1);
        }else{
            return array('msg'=>'保存错误','code'=>0);
        }
    }


}