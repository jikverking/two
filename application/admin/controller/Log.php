<?php
namespace app\admin\controller;
class Log extends Common
{
    public function indexs()
    {
        return json(['code'=>0,'msg'=>'删除失败']);
    }
    public function index()
    {
    	if(request() -> isPost()){
            $page = input('page')?input('page'):1;
            $pageSize =input('limit')?input('limit'):10;
            $map = [];
            $adminid = session('adminid');
            if($adminid != 1){
                $map['aid'] = $adminid; 
            }
            $list = db('log')
                 -> where($map)
                 -> order('id desc')
                 -> paginate(array('list_rows'=>$pageSize,'page'=>$page))
                 -> toArray();
            if($list['data']){     
                foreach ($list['data'] as $key => $value) {
                	$list['data'][$key]['aid'] = $this->aid($value['aid']);
                	$list['data'][$key]['pids'] = $this->pids($value['pids']);
                	$list['data'][$key]['rid'] = $this->rid($value['rid']);
                	$list['data'][$key]['pid'] = $this->pid($value['pid']);
                	$list['data'][$key]['content'] = $this->pid($value['pid']).'进行：'.$this->rid($value['rid']);
                    $list['data'][$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
                 /*   $list['data'][$key]['title'] = $this->title($value['group_id']);*/
                }  
            }             
            return json(['code'=>0,'msg'=>'获取成功!','data'=>$list['data'],'count'=>$list['total'],'rel'=>1]);
        }else{
            return $this->fetch();
        }
    }

    public function aid($aid)
    {
        $res = db('admin')->field('username')->where('adminid',$aid)->find();
        return $res['username'];
    }

    public function rid($rid)
    {
        $res = db('auth_rule')->field('title')->where('id',$rid)->find();
        return $res['title'];
    }

    public function pid($pid)
    {
        $res = db('auth_rule')->field('title')->where('id',$pid)->find();
        return $res['title'];
    }

     public function pids($pids)
    {
        $res = db('auth_rule')->field('title')->where('id',$pids)->find();
        return $res['title'];
    }

    //删除日志记录(删除数据)
    public function del()
    {
        if(request() ->isPost()){
            $id = $_POST['id']; 
            if(is_array($id)){
                //批量删除
                $all = db('log')->delete($id);
                if($all){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }else{
                //单条记录删除
                $del = db('log')->where('id',$id)->delete();
                if($del){
                    adminlog();
                    return json(['code'=>1,'msg'=>'删除成功']);
                }else{
                    return json(['code'=>0,'msg'=>'删除失败']);
                }
            }  
        }
    }
}