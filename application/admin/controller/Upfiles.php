<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Controller;
class Upfiles extends Controller
{
  
   public function upimages(){
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
            $result['src'] = '/uploads/'. $files.'/'. $path;
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

    public function upimage(){
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
            $result['src'] = '/uploads/'. $files.'/'. $path;
            return $result;
        }else{
            // 上传失败获取错误信息
            $result['code'] = 0;
            $result['msg'] = '上传失败!';
            return $result;
        }
    }
}