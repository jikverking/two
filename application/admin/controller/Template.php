<?php
namespace app\admin\controller;
use think\Db;
class Template extends Common
{
	protected $filepath,$publicpath,$viewSuffix;
    function _initialize()
    {
        parent::_initialize();
        $this->publicpath =  ROOT_PATH.'public/uploads/';
    }

	public function images()
	{

		$path = $this->publicpath.input('folder').'/';
		$uppath = explode('/',input('folder'));
        $leve = count($uppath)-1;
        unset($uppath[$leve]);
        if($leve>1){
            unset($uppath[$leve-1]);
            $uppath = implode('/',$uppath).'/';
        }else{
            $uppath = '';
        }
        $this->assign ( 'leve',$leve);
        $this->assign ( 'uppath',$uppath);
		$files = glob($path.'*');
        $folders=array();
        $templates = array();
        foreach($files as $key => $file) {
            $filename = basename($file);
            if(is_dir($file)){
                $folders[$key]['filename'] = $filename;
                $folders[$key]['filepath'] = $file;
                $folders[$key]['ext'] = 'folder';
            }else{
                $templates[$key]['filename'] = $filename;
                $templates[$key]['filepath'] = $file;
                $templates[$key]['ext'] = strtolower(substr($filename,strrpos($filename, '.')-strlen($filename)+1));
                if(!in_array($templates[$key]['ext'],array('gif','jpg','png','bmp'))) $templates[$key]['ico'] =1;
            }
        }
   
        $this->assign ( 'path',$path);
        $this->assign ( 'folders',$folders );
        $this->assign ( 'files',$templates );
        return $this->fetch();exit;
        return $this->fetch();
	}

	public function imgDel(){
        $path = $this->publicpath.input('post.folder');
        $file=$path.input('post.filename');
        if(file_exists($file)){
            is_dir($file) ? dir_delete($file) : unlink($file);
            $result['msg'] = '删除成功!';
            $result['code'] = 1;
            adminlog();
            return $result;
        }else{
            $result['msg'] = '文件不存在!';
            $result['code'] = 0;
            return $result;
        }
    }
}	