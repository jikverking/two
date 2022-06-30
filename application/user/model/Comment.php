<?php
namespace app\user\model;
use think\Model;
class Comment extends Model
{
    /**
     * @添加评论
     * $data      传输的数据
     * $table     表名
     */
    public function add($data,$table,$tables)
    {
        $insert = db($table)->insert($data);
        if($insert){
            $count = db($table)->where('gid',$data['gid'])->count();
            db($tables)->where('id',$data['gid'])->update(['num'=>$count]);
            return ['code'=>1,'msg'=>'添加成功'];
        }else{
            return ['code'=>0,'msg'=>'添加失败'];
        }
    }

    /**
     * @添加评论
     * $data      传输的数据
     * $table     表名
     */
    public function edit($fieldname,$conent,$data,$table)
    {
        $count = db($table)->where($data)->find();
        if($count){
            return ['code'=>1,'msg'=>'编辑成功'];
        }
        $insert = db($table)->where($fieldname,$conent)->update($data);
        if($insert){
            return ['code'=>1,'msg'=>'编辑成功'];
        }else{
            return ['code'=>0,'msg'=>'编辑失败'];
        }
    }
}