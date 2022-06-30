<?php
namespace app\admin\controller;
use think\Db;
class Database extends Common
{

    protected $db = '';
    function _initialize(){
    $dir = "Data";
    if(!is_dir($dir)){
        @mkdir($dir,0777,true);
    }
        parent::_initialize();
        $db=db('');
        $this->db = Db::connect();
    }

	//数据库管理
	public function database()
	{
		if(request() -> isPost()){
            $dbtables = $this->db->query("SHOW TABLE STATUS LIKE '".config('database.prefix')."%'");
            $total = 0;
            foreach ($dbtables as $k => $v) {
                $dbtables[$k]['size'] = format_bytes($v['Data_length']);
                $total += $v['Data_length'] + $v['Index_length'];
            }
            return $result = ['code'=>0,'msg'=>'获取成功!','data'=>$dbtables,'total'=>format_bytes($total),'tableNum'=>count($dbtables),'rel'=>1];
		}else{
			return $this->fetch();
		}
	}

    //备份
    public function backup(){
        if(request() -> isPost()){
            $tables = input('post.tables/a');
            $backup = new \org\Baksql(\think\Config::get("database"));
            if (!empty($tables)) {
                 foreach ($tables as $table) {
                    $backup->backup($table, 0);
                }
                adminlog();
                return ['code'=>1,'msg'=>'备份成功！'];
            } else {
                return ['code'=>0,'msg'=>'请选择要备份的表！'];
            }
        }
    }

    //优化
    public function optimize() {
        if(request() -> isPost()){
            $tables = input('tables/a');
            $backup = new \org\Baksql(\think\Config::get("database"));
            if (empty($tables)) {
                return ['code'=>0,'msg'=>'请选择要优化的表！'];
            }
            if($backup->optimize($tables)){
                adminlog();
                return ['code'=>1,'msg'=>'数据表优化成功！'];
            }else{
                return ['code'=>0,'msg'=>'数据表优化出错请重试！'];
            }
        }
    }

    //修复
    public function repair() {
        if(request() -> isPost()){    
            $tables = input('tables/a');
            $backup = new \org\Baksql(\think\Config::get("database"));
            if (empty($tables)) {
                return ['code'=>0,'msg'=>'请选择要修复的表！'];
            }
            if($backup->repair($tables)){
                adminlog();
                return ['code'=>1,'msg'=>'数据表修复成功！'];
            }else{
                return ['code'=>0,'msg'=>'数据表修复出错请重试！'];
            }
        }
    }

    //备份列表
    public function restore(){
        if(request()->isPost()){
            $backup = new \org\Baksql(\think\Config::get("database"));
            $list =   $backup->fileList();
            $lists = [];
            foreach ($list as $key => $value) {
                 $lists[] = $value;
            }
            return ['code'=>0,'msg'=>'获取成功!','data'=>$lists,'rel'=>1];
        }else{
            return $this->fetch();
        } 
    }

    //下载
    public function downFile($time) {
        $backup = new \org\Baksql(\think\Config::get("database"));
        $backup->downloadFile($time);
        adminlog();
    }

    //执行还原数据库操作
    public function import($time) {
        if(request() -> isPost())
        {   
            $backup = new \org\Baksql(\think\Config::get("database"));
            $list  = $backup->getFile('timeverif',$time);
            $backup->setFile($list)->import(1);
            adminlog();
            return ['code'=>1,'msg'=>'还原成功！'];
        }
    }

    //删除sql文件
    public function delSqlFiles() {
        if(request() -> isPost()){   
            $time = trim(input('post.time'));
            $backup = new \org\Baksql(\think\Config::get("database"));
            if($backup->delFile($time)){
                adminlog();
                return ['code'=>1,'msg'=>"备份文件删除成功！"];
            }else{
                return ['code'=>0,'msg'=>"备份文件删除失败，请检查权限！"];
            }
        }
    }
}