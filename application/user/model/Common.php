<?php
namespace app\user\model;
use think\Model;
use think\Db;
class Common extends Model
{
    /**
     * @查询信息列表
     * $table:   数据表名
     * $limit:   分页查询条数
     * $page:    当前页数
     * $query:   查询条件
     * $field    查询字段
     * $order    排序
     */
    public function lists($table,$limit,$page,$query,$field,$order)
    {
        $where = '';
        $and = '';
        $prefix = config('database.prefix');
        if(count($query)>0){
            $where.="WHERE ".implode(" AND ",$query);
            $and.="AND ".implode(" AND ",$query);
        }
        //return $where;
        $countSql  = "SELECT COUNT(*) FROM ".$prefix."$table ".$where."";
        $count     = Db::query($countSql)[0]['COUNT(*)'];
        $eIndex = ($page-1)*$limit + $limit;
        $sIndex = ($page-1)*$limit;
        $pagesize = ceil($count/$limit);
        if($count <= $limit || $page == $pagesize ){
            $eIndex = $count-1;
        }
        if($count != 0){
            $listSql = "SELECT "
                .$field
                ." FROM ".$prefix."$table WHERE id "
                ."BETWEEN "
                ."(SELECT id FROM ".$prefix."$table ".$where." ORDER BY id desc  LIMIT ".$eIndex.",1) "
                ."AND "
                ."(SELECT id FROM ".$prefix."$table ".$where." ORDER BY id desc  LIMIT ".$sIndex.",1) "
                .$and
                ." ORDER BY $order desc "
                ."LIMIT ".$limit;
            $list = Db::query($listSql);
            $data['list'] = $list;
        }else{
            $data['list'] = '';
        }
        $data['count'] = $count;
        return $data;
    }

    /**
     * @编辑状态
     * $datainfo: 传输的数据
     * $table:    表名
     */
    public function statu($datainfo,$table)
    {
        $id = $datainfo['id'];
        $statu = $datainfo['statu'];
        $update =db($table)->where('id', $id)->update(['statu' => $statu]);
        if($update){
            return ['code'=>1,'msg'=>'编辑成功'];
        }else{
            return ['code'=>0,'msg'=>'编辑失败'];
        }
    }

    /**
     * @删除数据
     * $id:     ID
     * $table:  表名
     */
    public function del($id,$table)
    {
        if(is_array($id)){
            //批量删除
            $del = db($table)->delete($id);
        }else{
            //单条记录删除
            $del = db($table)->where('id',$id)->delete();
        }
        if($del){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }

    /**
     * @评论删除数据
     * $id:     ID
     * $table:  表名
     * $tables: 分组表
     * $gid:    分组编号
     */
    public function dels($id,$table,$tables,$gid)
    {
        if(is_array($id)){
            //批量删除
            $del = db($table)->delete($id);
        }else{
            //单条记录删除
            $del = db($table)->where('id',$id)->delete();
        }
        if($del){
            $count = db($table)->where('gid',$gid)->count();
            db($tables)->where('id',$gid)->update(['num'=>$count]);
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }

    /**
     * @删除数据
     * $id:     ID
     * $table:  表名
     * $tables  下级表
     */
    public function groupdel($id,$table,$tables)
    {
        ignore_user_abort(true); // 后台运行
        set_time_limit(0); // 取消脚本运行时间的超时上限
        $lists = [];
        if(is_array($id)){
            //批量删除
            $del = db($table)->delete($id);
            foreach ($id as $key => $value)
            {
                $res = db($tables)->field('id')->where('gid',$value)->select();
                $lists = array_merge($res,$lists);

            }
        }else{
            //单条记录删除
            $lists = db($tables)->field('id')->where('gid',$id)->select();
            $del = db($table)->where('id',$id)->delete();
        }
        //将二维数组转化成一维
        $lists = array_column($lists,'id');
        if($del){
            try {
                db($tables)->delete($lists);
                return ['code'=>1,'msg'=>'删除成功'];
            } catch (Exception $e) {
                return ['code'=>1,'msg'=>'删除成功,但是评论删除异常捕获发现异常'];
            }
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }


    /**
     * @添加
     * $data      传输的数据
     * $table     表名
     */
    public function adds($data,$table,$tables)
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
     * @编辑
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

    /**
     * @编辑组
     * $data      传输的数据
     * $table     表名
     */
    public function edits($fieldname,$conent,$data,$table)
    {
        $count = db($table)->where($data)->find();
        if($count){
            return ['code'=>1,'msg'=>'编辑成功'];
        }
        $data['updatetime'] = time();
        $insert = db($table)->where($fieldname,$conent)->update($data);
        if($insert){
            return ['code'=>1,'msg'=>'编辑成功'];
        }else{
            return ['code'=>0,'msg'=>'编辑失败'];
        }
    }

    /**
     * @添加
     * $data      传输的数据
     * $table     表名
     */
    public function add($data,$table)
    {
        $insert = db($table)->insert($data);
        if($insert){
            return ['code'=>1,'msg'=>'添加成功'];
        }else{
            return ['code'=>0,'msg'=>'添加失败'];
        }
    }


    /**
     * @处理大数据
     * @数据库水平分表
     * @当数据量达到一定程度自动创建数据表,并修改联合表
     * $tables:        子表
     * $tabledata:     主表
     * $nums:          表的数量
     */
    public function leveltable($tables,$tabledata,$nums = 1000000)
    {
        $prefix = config('database.prefix');
        /**
         * $tableinfo显示所有的数据表信息
         */
        $tableinfo = Db::connect()->query("SHOW TABLE STATUS LIKE '".$prefix.$tables."%'");
        $tablename = '';
        if(is_array($tableinfo)){
            foreach ($tableinfo as $key =>$value){
                $tablename.= $value['Name'].',';
            }
        }
        $tablename = substr($tablename,0,-1);
        $last = array_pop($tableinfo);
        if($last){
            $count = Db::table($last['Name'])->count();
            /**
             * 判断数据量达到的条数，达到进行表的创建和联合修改
             */
            if($count >= $nums){
                $infoname = $last['Name'];
                $str = str_replace($prefix.$tables,'', $infoname);
                $num = $str+1;
                $lastname = $prefix.$tables.$num;
                $strstr = strpos($tablename,$lastname);
                if($strstr == false){
                    Db::query("create table $lastname like $infoname");
                    $tableinfos = Db::connect()->query("SHOW TABLE STATUS LIKE '".$prefix.$tables."%'");
                    $tablenames = '';
                    if(is_array($tableinfos)){
                        foreach ($tableinfos as $key =>$value){
                            $tablenames.= $value['Name'].',';
                        }
                    }
                    $tablenames = substr($tablenames,0,-1);
                    if($tablenames){
                        $table = $prefix.$tabledata;
                        Db::query("alter table $table UNION = (".$tablenames.")");
                    }
                }
            }
        }
    }
}